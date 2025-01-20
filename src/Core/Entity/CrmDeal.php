<?php

declare(strict_types=1);

namespace Debishev\Bitrix24Library\Core\Entity;



use DateTimeImmutable;
use DateTimeInterface;
use Debishev\Bitrix24Library\Core\Entity\Traits\EntityFieldsTrait;
use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class CrmDeal
{
    use EntityFieldsTrait;

    public ?string $ID;
    public ?string $TITLE;
    public ?string $TYPE_ID;
    public ?string $STAGE_ID;
    public ?string $PROBABILITY;
    public ?string $CURRENCY_ID;
    public ?string $OPPORTUNITY = '0.0';
    public ?string $IS_MANUAL_OPPORTUNITY;
    public string $TAX_VALUE = '0.0';
    public ?string $LEAD_ID;
    public ?string $COMPANY_ID;
    public ?string $CONTACT_ID;
    public ?string $QUOTE_ID;
    public ?DateTimeInterface $BEGINDATE;
    public ?DateTimeInterface $CLOSEDATE;
    public ?string $ASSIGNED_BY_ID;
    public ?string $CREATED_BY_ID;
    public ?string $MODIFY_BY_ID;
    public ?DateTimeInterface $DATE_CREATE;
    public ?DateTimeInterface $DATE_MODIFY;
    public string $OPENED;
    public string $CLOSED;
    public ?string $COMMENTS;
    public ?string $ADDITIONAL_INFO;
    public ?string $LOCATION_ID;
    public string $CATEGORY_ID;
    public string $STAGE_SEMANTIC_ID;
    public string $IS_NEW;
    public string $IS_RECURRING;
    public string $IS_RETURN_CUSTOMER;
    public string $IS_REPEATED_APPROACH;
    public ?string $SOURCE_ID;
    public ?string $SOURCE_DESCRIPTION;
    public ?string $ORIGINATOR_ID;
    public ?string $ORIGIN_ID;
    public ?string $MOVED_BY_ID;
    public ?DateTimeInterface $MOVED_TIME;
    public ?DateTimeInterface$LAST_ACTIVITY_TIME;
    public ?string $UTM_SOURCE;
    public ?string $UTM_MEDIUM;
    public ?string $UTM_CAMPAIGN;
    public ?string $UTM_CONTENT;
    public ?string $UTM_TERM;
    public ?string $LAST_ACTIVITY_BY;

    public array $customFields = [];


    function __construct(array $data = []) {
       $this->fillData($data);
    }
    
    
    

}
