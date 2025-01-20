<?php

namespace Debishev\Bitrix24Library\Core\Entity;

use DateTimeImmutable;
use Debishev\Bitrix24Library\Core\Entity\Traits\EntityFieldsTrait;

class CrmCompany
{
    use EntityFieldsTrait;

    public string $ID;
    public string $COMPANY_TYPE;
    public string $TITLE;
    public ?string $LOGO;
    public ?string $LEAD_ID;
    public string $HAS_PHONE;
    public string $HAS_EMAIL;
    public string $HAS_IMOL;
    public string $ASSIGNED_BY_ID;
    public string $CREATED_BY_ID;
    public string $MODIFY_BY_ID;
    public ?string $BANKING_DETAILS;
    public ?string $INDUSTRY;
    public ?string $REVENUE;
    public ?string $CURRENCY_ID;
    public ?string $EMPLOYEES;
    public ?string $COMMENTS;
    public DateTimeImmutable $DATE_CREATE;
    public DateTimeImmutable $DATE_MODIFY;
    public string $OPENED;
    public string $IS_MY_COMPANY;
    public ?string $ORIGINATOR_ID;
    public ?string $ORIGIN_ID;
    public ?string $ORIGIN_VERSION;
    public DateTimeImmutable $LAST_ACTIVITY_TIME;
    public ?string $ADDRESS;
    public ?string $ADDRESS_2;
    public ?string $ADDRESS_CITY;
    public ?string $ADDRESS_POSTAL_CODE;
    public ?string $ADDRESS_REGION;
    public ?string $ADDRESS_PROVINCE;
    public ?string $ADDRESS_COUNTRY;
    public ?string $ADDRESS_COUNTRY_CODE;
    public ?string $ADDRESS_LOC_ADDR_ID;
    public ?string $ADDRESS_LEGAL;
    public ?string $REG_ADDRESS;
    public ?string $REG_ADDRESS_2;
    public ?string $REG_ADDRESS_CITY;
    public ?string $REG_ADDRESS_POSTAL_CODE;
    public ?string $REG_ADDRESS_REGION;
    public ?string $REG_ADDRESS_PROVINCE;
    public ?string $REG_ADDRESS_COUNTRY;
    public ?string $REG_ADDRESS_COUNTRY_CODE;
    public ?string $REG_ADDRESS_LOC_ADDR_ID;
    public ?string $UTM_SOURCE;
    public ?string $UTM_MEDIUM;
    public ?string $UTM_CAMPAIGN;
    public ?string $UTM_CONTENT;
    public ?string $UTM_TERM;
    public string $LAST_ACTIVITY_BY;


    public array $customFields = [];

    /** @var array<array{ID: string, VALUE_TYPE: string, VALUE: string, TYPE_ID: string}> */
    public array $PHONE;


    public function __construct(array $data = [])
    {
        $this->fillData($data);
    }

}