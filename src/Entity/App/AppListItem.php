<?php

namespace Debishev\Bitrix24Library\Entity\App;

class AppListItem
{
    public int $id;
    public string $subTitle;
    public string $title;
    public string $status;
    public string $value;
    public string $description;
    public array $actions = [];
}