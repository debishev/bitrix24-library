<?php

namespace Debishev\Bitrix24Library\Core\Entity;

use Debishev\Bitrix24Library\Core\Entity\Traits\EntityFieldsTrait;

class CrmPipelineStage
{
    use EntityFieldsTrait;

    public string $STATUS_ID;

    public int $SORT;
    public string $NAME;
    public bool $isClosed;
    public bool $isSuccess;

    public function __construct(array $data = [])
    {
        $this->fillData($data);
    }




}