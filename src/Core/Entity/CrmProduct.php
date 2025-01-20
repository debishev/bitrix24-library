<?php

declare(strict_types=1);

namespace Debishev\Bitrix24Library\Core\Entity;



use DateTimeImmutable;
use Debishev\Bitrix24Library\Core\Entity\Traits\EntityFieldsTrait;

class CrmProduct
{
    use EntityFieldsTrait;

    public string $ID;
    public string $NAME;
    public ?string $CODE;
    public string $ACTIVE;
    public ?string $PREVIEW_PICTURE;
    public ?string $DETAIL_PICTURE;
    public string $SORT;
    public ?string $XML_ID;
    public DateTimeImmutable $TIMESTAMP_X;
    public DateTimeImmutable $DATE_CREATE;
    public string $MODIFIED_BY;
    public string $CREATED_BY;
    public string $CATALOG_ID;
    public ?string $SECTION_ID;
    public ?string $DESCRIPTION;
    public string $DESCRIPTION_TYPE;
    public ?float $PRICE;
    public ?string $CURRENCY_ID;
    public ?string $VAT_ID;
    public string $VAT_INCLUDED;
    public ?string $MEASURE;

    public array $customFields = [];

    public function __construct(array $data = [])
    {
        $this->fillData($data);
    }


}