<?php

namespace Debishev\Bitrix24Library\Core\Utils;

class MoneyUtils
{
    static function formatMoney($price): string
    {
        return number_format($price, 0, '.', ' ');
    }
}