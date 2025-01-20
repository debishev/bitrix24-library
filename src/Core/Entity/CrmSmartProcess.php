<?php
declare(strict_types=1);
namespace Debishev\Bitrix24Library\Core\Entity;



use DateTimeImmutable;
use Debishev\Bitrix24Library\Core\Entity\Traits\EntityFieldsTrait;

class CrmSmartProcess
{
    use EntityFieldsTrait;

    public int $id;
    public string $xmlId;
    public string $title;
    public int $createdBy;
    public int $updatedBy;
    public int $movedBy;
    public DateTimeImmutable $createdTime;
    public DateTimeImmutable $updatedTime;
    public DateTimeImmutable $movedTime;
    public int $categoryId;
    public string $opened;
    public string $stageId;
    public string $previousStageId;
    public DateTimeImmutable $begindate;
    public DateTimeImmutable $closedate;
    public int $companyId;
    public int $contactId;
    public float $opportunity;
    public string $isManualOpportunity;
    public float $taxValue;
    public string $currencyId;
    public int $mycompanyId;
    public string $sourceId;
    public string $sourceDescription;
    public int $webformId;
    public int $assignedById;
    public int $lastActivityBy;
    public DateTimeImmutable $lastActivityTime;
    public int $parentId2;
    public ?string $utmSource;
    public ?string $utmMedium;
    public ?string $utmCampaign;
    public ?string $utmContent;
    public ?string $utmTerm;
    public array $observers;

    /** @var array<int> */
    public array $contactIds;

    public int $entityTypeId;

    public array $customFields = [];

    public function __construct(array $data = [])
    {
        $this->fillData($data);
    }

}