<?php

namespace Debishev\Bitrix24Library\Core\Utils;


use Debishev\Bitrix24Library\Core\Driver\CRMDriverClass;
use Debishev\Bitrix24Library\Core\Entity\CrmUser;
use Symfony\Bundle\SecurityBundle\Security;

class AuthHelper
{


    static function autologinUser(Security $security, int $bitrixUserId, CRMDriverClass $crmDriverClass): CrmUser
    {
        $user = $crmDriverClass->getUser($bitrixUserId);
        $security->login($user,'security.authenticator.access_token.bitrix_api');
        return $user;
    }
}