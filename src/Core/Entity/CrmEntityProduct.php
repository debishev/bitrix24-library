<?php

namespace Debishev\Bitrix24Library\Core\Entity;

use Debishev\Bitrix24Library\Core\Entity\Traits\EntityFieldsTrait;

class CrmEntityProduct
{
    use EntityFieldsTrait;

    public int $id;
    public int $ownerId;
    public string $ownerType;
    public int $productId;
    public string $productName;
    public float $price;
    public float $priceAccount;
    public float $priceExclusive;
    public float $priceNetto;
    public float $priceBrutto;
    public int $quantity;
    public int $discountTypeId;
    public float $discountRate;
    public float $discountSum;
    public ?float $taxRate;
    public string $taxIncluded;
    public string $customized;
    public int $measureCode;
    public string $measureName;
    public int $sort;
    public ?string $xmlId;
    public int $type;

    public function __construct(array $data = [])
    {
        $this->fillData($data);
    }
}