<?php

namespace Debishev\Bitrix24Library\Core\Entity;

use DateTimeImmutable;
use Debishev\Bitrix24Library\Core\Entity\Traits\EntityFieldsTrait;

class CrmActivity
{
    use EntityFieldsTrait;

    public string $ID;
    public string $OWNER_ID;
    public string $OWNER_TYPE_ID;
    public string $TYPE_ID;
    public string $PROVIDER_ID;
    public string $PROVIDER_TYPE_ID;
    public ?string $PROVIDER_GROUP_ID;
    public ?string $ASSOCIATED_ENTITY_ID;
    public string $SUBJECT;
    public DateTimeImmutable $CREATED;
    public DateTimeImmutable $LAST_UPDATED;
    public ?DateTimeImmutable $START_TIME;
    public ?DateTimeImmutable $END_TIME;
    public DateTimeImmutable $DEADLINE;
    public string $COMPLETED;
    public string $STATUS;
    public string $RESPONSIBLE_ID;
    public string $PRIORITY;
    public string $NOTIFY_TYPE;
    public string $NOTIFY_VALUE;
    public ?string $DESCRIPTION;
    public string $DESCRIPTION_TYPE;
    public string $DIRECTION;
    public ?string $LOCATION;
    public array $SETTINGS;
    public ?string $ORIGINATOR_ID;
    public ?string $ORIGIN_ID;
    public string $AUTHOR_ID;
    public string $EDITOR_ID;

    /** @var array{clientId: string, badgeCode: ?string} */
    public array $PROVIDER_PARAMS;

    public ?string $PROVIDER_DATA;
    public string $RESULT_MARK;
    public ?string $RESULT_VALUE;
    public ?string $RESULT_SUM;
    public ?string $RESULT_CURRENCY_ID;
    public string $RESULT_STATUS;
    public string $RESULT_STREAM;
    public ?string $RESULT_SOURCE_ID;
    public string $AUTOCOMPLETE_RULE;

    public function __construct(array $data = [])
    {
        $this->fillData($data);
    }

}