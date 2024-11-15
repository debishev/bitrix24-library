<?php

namespace Debishev\Bitrix24Library\Core\ConnectorDriver;

use Debishev\Bitrix24Library\Core\ConnectorDriver\Traits\CompanyTrait;
use Debishev\Bitrix24Library\Core\ConnectorDriver\Traits\ContactTrait;
use Debishev\Bitrix24Library\Core\ConnectorDriver\Traits\DealActivityTrait;
use Debishev\Bitrix24Library\Core\ConnectorDriver\Traits\DealTrait;
use Debishev\Bitrix24Library\Core\ConnectorDriver\Traits\PipelineTrait;
use Debishev\Bitrix24Library\Core\ConnectorDriver\Traits\SmartProcessTrait;
use Debishev\Bitrix24Library\Core\ConnectorDriver\Traits\UserTrait;
use Debishev\Bitrix24Library\Core\DataMappers\CRMBitrixMapper;
use Generator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Bitrix24ApiConnectorDriver
{

    use UserTrait;
    use SmartProcessTrait;
    use DealTrait;
    use ContactTrait;
    use DealActivityTrait;
    use PipelineTrait;
    use CompanyTrait;

    public string $webhookUrl = '';
    public string $baseUrl = '';
    protected array $lastResponse ;

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        protected CRMBitrixMapper $crmBitrixMapper
    )
    { }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function request(string $command, array $params): mixed
    {
        $result = $this->httpClient->request('POST',$this->getUrl($command),[
            'headers' => [
                'Content-Type' => 'application/json',
                'Connection' => 'close',
            ],
            'body' => $params
        ]);

//        $this->lastResponse = json_decode($result->getContent(), true);


        try {
            $this->lastResponse = json_decode($result->getContent(), true);
        } catch (\Exception $exception) {
            $this->lastResponse = [];
        }




        if ($result->getStatusCode() != 200) {
            $httpCode = $result->getStatusCode();
            $jsonParams = $this->toJSON($params);
            $jsonResponse = $this->toJSON($this->lastResponse);
            throw new HttpException( 500,
                "Ошибка: HTTP код {$httpCode} при запросе '{$command}' ({$jsonParams}): {$jsonResponse}"
            );
        }

        if (! empty($this->lastResponse['error']) || ! empty($this->lastResponse['error_description'])) {
            $jsonParams = $this->toJSON($params);
            $jsonResponse = $this->toJSON($this->lastResponse);
            throw new HttpException(500,"Ошибка при запросе '{$command}' ({$jsonParams}): {$jsonResponse}");
        }



        return $this->lastResponse['result'] ?? $this->lastResponse;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function requestByAuth(string $command, array $params, string $authKey): mixed
    {
        $result = $this->httpClient->request('POST',$this->getUrlByAuth($command, $authKey),[
            'headers' => [
                'Content-Type' => 'application/json',
                'Connection' => 'close',
            ],
            'body' => $params
        ]);

//        $this->lastResponse = json_decode($result->getContent(), true);


        try {
            $this->lastResponse = json_decode($result->getContent(), true);
        } catch (\Exception $exception) {
            $this->lastResponse = [];
        }




        if ($result->getStatusCode() != 200) {
            $httpCode = $result->getStatusCode();
            $jsonParams = $this->toJSON($params);
            $jsonResponse = $this->toJSON($this->lastResponse);
            throw new HttpException( 500,
                "Ошибка: HTTP код {$httpCode} при запросе '{$command}' ({$jsonParams}): {$jsonResponse}"
            );
        }

        if (! empty($this->lastResponse['error']) || ! empty($this->lastResponse['error_description'])) {
            $jsonParams = $this->toJSON($params);
            $jsonResponse = $this->toJSON($this->lastResponse);
            throw new HttpException(500,"Ошибка при запросе '{$command}' ({$jsonParams}): {$jsonResponse}");
        }



        return $this->lastResponse['result'] ?? $this->lastResponse;
    }



    /**
     * Возвращает список всех сущностей
     *
     * @param  string $function Имя метода (функции) запроса
     * @param  array  $params   Параметры
     *                          запроса
     * @return Generator
     * @see    https://dev.1c-bitrix.ru/rest_help/general/lists.php
     */
    public function getList(string $command, array $params = []): Generator
    {

        do {
            // До 50 штук на 1 запрос
            $result = $this->request(
                $command,
                $params
            );

            yield $result;

            if (empty($this->lastResponse['next'])) {
                break;
            }

            $params['start'] = $this->lastResponse['next'];
        } while (true);
    }

    /**
     * Возвращает список всех сущностей используя быстрый метод
     *
     * @see    https://dev.1c-bitrix.ru/rest_help/rest_sum/start.php
     * @param  string $function Имя метода (функции) запроса
     * @param  array  $params   Параметры
     *                          запроса
     * @return Generator
     * @see    https://dev.1c-bitrix.ru/rest_help/general/lists.php
     */
    public function fetchList(string $function, array $params = []): Generator
    {
        $params['order']['ID'] = 'ASC';
        $params['filter']['>ID'] = 0;
        $params['start'] = -1;


        do {
            // До 50 штук на 1 запрос
            $result = $this->request(
                $function,
                $params
            );

            $resultCounter = count($result);



            yield $result;

            if ($resultCounter < 50) {
                break;
            }

            $params['filter']['>ID'] = $result[ $resultCounter - 1 ]['ID'];
        } while (true);
    }

    public function getOneItem(string $command, array $params): array
    {
        return $this->request(
            $command,
            $params
        );
    }

    private function getUrl(string $cmd): string
    {

        return $this->webhookUrl . '/' . $cmd .'.json';
    }

    private function getUrlByAuth(string $cmd, string $authKey): string
    {

        return $this->baseUrl . '/' . $cmd .'.json?auth='.$authKey;
    }


    private function toJSON($data, bool $prettyPrint = false): string
    {
        $encodeOptions = JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR;

        if ($prettyPrint) {
            $encodeOptions |= JSON_PRETTY_PRINT;
        }

        $jsonParams = json_encode($data, $encodeOptions);
        if ($jsonParams === false) {
            $jsonParams = print_r($data, true);
        }

        return $jsonParams;
    }

}