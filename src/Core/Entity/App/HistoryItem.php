<?php

namespace Debishev\Bitrix24Library\Core\Entity\App;

use DateTimeImmutable;

class HistoryItem
{
    public ?int $id = null;
    public DateTimeImmutable $date;
    public string $subTitle;
    public string $title;
    public string $status;
    public string $value;
    public string $description;
    public array $actions = [];
}