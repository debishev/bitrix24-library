<?php

namespace Debishev\Bitrix24Library\RequestMapper;



class Bitrix24LibraryWebhookRequestMapper
{

    public function __construct(
        public array $auth,
        public array $document_id,
    )
    {

    }

    function getDealId(): int
    {
        return intval( str_ireplace('DEAL_','',$this->document_id[2])  );
    }
}