<?php

namespace Debishev\Bitrix24Library\Core\Enum;

enum Bitrix24CrmEntityProductOwnerTypeEnum: string
{
    case LEAD = "L";
    case DEAL = "D";
    case CONTACT = "C";
    case COMPANY = "CO";
    case INVOICE = "I";
    case SMART_INVOICE = "SI";
    case QUOTE = "Q";
    case REQUISITE = "RQ";
    case ORDER = "O";

    function getSmartProcessHex($decimalId): string {
        // Преобразуем число в шестнадцатеричную систему
        $hex = dechex($decimalId);

        // Если результат состоит из одного символа, добавляем ведущий ноль
        if (strlen($hex) == 1) {
            $hex = '0' . $hex;
        }

        return $hex;
    }
}
