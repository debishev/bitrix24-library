<?php

namespace Debishev\Bitrix24Library\RequestMapper;



class Bitrix24LibraryAppRequestMapper
{

    public array $PLACEMENT_OPTIONS = [];
    public function __construct(
        public string $AUTH_ID,
        public string $AUTH_EXPIRES,
        public string $REFRESH_ID,
        public string $member_id,
        public string $status,
        public string $PLACEMENT,
        string $PLACEMENT_OPTIONS,
    )
    {
        $this->PLACEMENT_OPTIONS = (array) json_decode($PLACEMENT_OPTIONS, true);
    }
}