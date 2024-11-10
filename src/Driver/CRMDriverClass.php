<?php

namespace Debishev\Bitrix24Library\Driver;



use Debishev\Bitrix24Library\ConnectorDriver\Bitrix24ApiConnectorDriver;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;


class CRMDriverClass
{



    public function __construct(
        private readonly Bitrix24ApiConnectorDriver $bitrix24ApiConnector,
        ContainerBagInterface $containerBag
    )
    {
        $url = $containerBag->get('bx.webhook.url');
        $this->bitrix24ApiConnector->webhookUrl = 'https://domain.loc/rest/1/1234';
        $this->bitrix24ApiConnector->baseUrl = 'https://domain.locg/rest';
    }




}
