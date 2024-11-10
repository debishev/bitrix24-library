<?php

namespace Debishev\Bitrix24Library\Entity\App;

class AppListItemAction
{
    public int $id;
    public string $title;
    public string $icon = '';
    public bool $isMain = false;
    public bool $isNeedConfirm = false;
    public bool $isNeedComment = false;
    public string $confirmTxt = '';
    public string $confirmOkButtonTxt = '';
    public string $confirmCancelButtonTxt = '';
    public ?array $requestParams = null;
}