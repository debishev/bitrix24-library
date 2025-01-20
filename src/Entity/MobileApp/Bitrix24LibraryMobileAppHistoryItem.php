<?php

namespace Debishev\Bitrix24Library\Entity\MobileApp;

use DateTimeImmutable;

class Bitrix24LibraryMobileAppHistoryItem
{
    public ?int $id = null;
    public DateTimeImmutable $date;
    public string $title;
    public string $subTitle;
    public string $overTitle;
    public string $description;
}