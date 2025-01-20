<?php

namespace Debishev\Bitrix24Library\Entity\MobileApp;

class Bitrix24LibraryMobileAppTaskItem
{
    public int $id;
    public ?string $title = null;
    public ?string $subTitle = null;
    public ?string $overTitle = null;

    public string $description;
    public array $actions = [];
}