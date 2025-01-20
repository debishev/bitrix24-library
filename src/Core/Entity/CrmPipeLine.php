<?php

namespace Debishev\Bitrix24Library\Core\Entity;

use Debishev\Bitrix24Library\Core\Entity\Traits\EntityFieldsTrait;

class CrmPipeLine
{
    use EntityFieldsTrait;
    public int $id;
    public string $name;
    public int $sort;
    public int $entityTypeId;
    public string $isDefault;
    public string $originId;
    public string $originatorId;
    public array $stages = [];

    public function __construct(array $data = [])
    {
        $this->fillData($data);

    }


}