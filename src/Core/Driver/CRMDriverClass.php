<?php

namespace Debishev\Bitrix24Library\Core\Driver;



use Debishev\Bitrix24Library\Core\ConnectorDriver\Bitrix24ApiConnectorDriver;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;


class CRMDriverClass
{



    public function __construct(
        protected readonly Bitrix24ApiConnectorDriver $bitrix24ApiConnector,
        private readonly ContainerBagInterface $containerBag
    )
    { }


    public function setup(string $webhookUrl, string $baseUrl): void
    {
        $this->bitrix24ApiConnector->webhookUrl = $webhookUrl;
        $this->bitrix24ApiConnector->baseUrl = $baseUrl;
    }


}
