<?php

namespace Debishev\Bitrix24Library\Entity\MobileApp;


use Debishev\Bitrix24Library\Enums\MobileApp\Bitrix24LibraryMobileAppCommandTypeEnum;



class Bitrix24LibraryMobileAppTaskItemAction
{
    public int $id;
    public string $title;
    public string $icon = '';
    public bool $isMain = false;
    public bool $isNeedComment = false;
    public bool $isNeedConfirm = false;
    public string $comment = "";
    public Bitrix24LibraryMobileAppCommandTypeEnum $command;
//    public bool $isNeedConfirm = false;
//    public bool $isNeedComment = false;
//    public string $confirmTxt = '';
//    public string $confirmOkButtonTxt = '';
//    public string $confirmCancelButtonTxt = '';
//    public ?array $requestParams = null;
}