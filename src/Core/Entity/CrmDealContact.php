<?php

namespace Debishev\Bitrix24Library\Core\Entity;

use DateTimeImmutable;
use Debishev\Bitrix24Library\Core\Entity\Traits\EntityFieldsTrait;

class CrmDealContact
{

    use EntityFieldsTrait;

    public string $ID;
    public ?string $POST;
    public ?string $COMMENTS;
    public ?string $HONORIFIC;
    public string $NAME;
    public ?string $SECOND_NAME;
    public ?string $LAST_NAME;
    public ?string $PHOTO;
    public ?string $LEAD_ID;
    public string $TYPE_ID;
    public ?string $SOURCE_ID;
    public ?string $SOURCE_DESCRIPTION;
    public ?string $COMPANY_ID;
    public ?string $BIRTHDATE;
    public string $EXPORT;
    public string $HAS_PHONE;
    public string $HAS_EMAIL;
    public string $HAS_IMOL;
    public DateTimeImmutable $DATE_CREATE;
    public DateTimeImmutable $DATE_MODIFY;
    public string $ASSIGNED_BY_ID;
    public string $CREATED_BY_ID;
    public string $MODIFY_BY_ID;
    public string $OPENED;
    public ?string $ORIGINATOR_ID;
    public ?string $ORIGIN_ID;
    public ?string $ORIGIN_VERSION;
    public ?string $FACE_ID;
    public DateTimeImmutable $LAST_ACTIVITY_TIME;
    public ?string $ADDRESS;
    public ?string $ADDRESS_2;
    public ?string $ADDRESS_CITY;
    public ?string $ADDRESS_POSTAL_CODE;
    public ?string $ADDRESS_REGION;
    public ?string $ADDRESS_PROVINCE;
    public ?string $ADDRESS_COUNTRY;
    public ?string $ADDRESS_LOC_ADDR_ID;
    public ?string $UTM_SOURCE;
    public ?string $UTM_MEDIUM;
    public ?string $UTM_CAMPAIGN;
    public ?string $UTM_CONTENT;
    public ?string $UTM_TERM;
    public string $LAST_ACTIVITY_BY;

    /** @var array<array{ID: string, VALUE_TYPE: string, VALUE: string, TYPE_ID: string}> */
    public array $PHONE;

    public array $customFields = [];

        public function __construct(array $data = [])
        {
            $this->fillData($data);
        }
}