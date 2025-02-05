<?php

namespace Debishev\Bitrix24Library\Core\ConnectorDriver;

use DateTimeImmutable;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Bitrix24AuthConnectorDrive
{

    private string $settingsFile;
    private array $appSettings = [];

    private int $tokenRefreshedTime = 0;

    public function __construct(
        private string $clientId,
        private string $clientSecret,
        private readonly HttpClientInterface $httpClient,
        private readonly KernelInterface $kernel,
    )
    {
        $this->settingsFile = $this->kernel->getProjectDir().'/bitrix24/settings.json';
    }

    function call(string $method,array $params): mixed
    {
        $rData = [
            'method' => $method,
            'params' => $params
        ];

        return $this->sendRequest($method, $params);
    }


    private function sendRequest(string $cmd,array $params): array
    {
        $result = $this->httpClient->request(
            method: 'POST',
            url: $this->getUrl($cmd),
            options: [
                'json' => $params,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            ]
        );

        if ($result->getStatusCode() === 401) {
            if ($this->tokenRefreshedTime === 0) {
                $this->refreshAccessToken();
                $result = $this->sendRequest($cmd, $params);
            }
        } else {
            $result = $result->getContent(false);
            $result = json_decode($result, true);
        }


        return $result;
    }


    public function installApp(string $code): bool
    {
        $token =  $this->sendAuthRequest(code: $code);

        return true;
    }

    private function refreshAccessToken(): void {
        $refreshToken = $this->getSettings()['refresh_token'];
        $result = $this->httpClient->request(
            method: 'GET',
            url: "https://oauth.bitrix.info/oauth/token/?grant_type=refresh_token&client_id={$this->clientId}&client_secret={$this->clientSecret}&refresh_token={$refreshToken}",
            options: [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]
        );

        $this->setSettings($result->toArray());
        $this->tokenRefreshedTime++;
    }

    private function sendAuthRequest(string $code): array
    {
        $result = $this->httpClient->request(
            method: 'GET',
            url: "https://oauth.bitrix.info/oauth/token/?grant_type=authorization_code&client_id={$this->clientId}&client_secret={$this->clientSecret}&code={$code}",
            options: [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]
        );

        $result = $result->toArray();

        $this->setSettings($result);

        return $result;
    }



    private function getSettings(): array
    {
        if (count($this->appSettings) == 0) {
            $this->appSettings = json_decode(file_get_contents($this->settingsFile), true);
        }
        return $this->appSettings;
    }

    private function setSettings(array $settings): void
    {
        $filesystem = new Filesystem();
        $settings['updated_at'] = (new DateTimeImmutable());
        $this->appSettings = $settings;
        $filesystem->dumpFile($this->settingsFile, json_encode($settings));
    }

    private function getUrl(string $cmd): string
    {
        $this->getSettings();
        $domain = $this->appSettings['client_endpoint'];
        $accessToken = $this->appSettings['access_token'];
        return "{$domain}{$cmd}.json?auth={$accessToken}";
    }

}