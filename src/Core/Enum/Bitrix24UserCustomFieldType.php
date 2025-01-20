<?php

namespace Debishev\Bitrix24Library\Core\Enum;

enum Bitrix24UserCustomFieldType: string
{
    case STRING = "string"; // строка
    case INTEGER = "integer"; // целое число
    case DOUBLE = "double"; // число
    case DATE = "date"; // дата
    case DATETIME = "datetime"; // дата со временем
    case BOOLEAN = "boolean"; // Да / Нет
    case FILE = "file"; // файл
    case ENUMERATION = "enumeration"; // список
    case URL = "url"; // ссылка
    case ADDRESS = "address"; // адрес Google карты
    case MONEY = "money"; // деньги
    case IBLOCK_SECTION = "iblock_section"; // Привязка к разделу инфоблока
    case IBLOCK_ELEMENT = "iblock_element"; // Привязка к элементу инфоблока
    case EMPLOYEE = "employee"; // Привязка к пользователю
    case CRM = "crm"; // Привязка к элементу CRM
    case CRM_STATUS = "crm_status"; // Привязка к справочнику CRM

}