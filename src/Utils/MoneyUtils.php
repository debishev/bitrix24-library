<?php

namespace Debishev\Bitrix24Library\Utils;

class MoneyUtils
{
    static function formatMoney($price): string
    {
        return number_format($price, 0, '.', ' ');
    }
}