<?php

namespace Debishev\Bitrix24Library\Core\Handler;

use Debishev\Bitrix24Library\Enums\MobileApp\Bitrix24LibraryMobileAppCommandTypeEnum;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface Bitrix24LibraryUserRoleHandlerInterface
{
    public function execCommand(Bitrix24LibraryMobileAppCommandTypeEnum $command, array $params): array;
    public function getMyHistory(array $params): array;
    public function getUserMenu(): array;

    public function startScreenAfterLogin(): string;

}