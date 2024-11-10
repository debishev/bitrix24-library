<?php
declare(strict_types=1);
namespace Debishev\Bitrix24Library\Core\Entity;



class CrmSmartProcess
{
    private int $id = 0;
    private string $title = '';
    private int $createdBy = 0;
    private bool $isOpen = false;
    private int $deal = 0;
    private int $sum;

    private array $customFields = [];

    private int $entityTypeId = 0;

    private int $contact = 0;

    private string $stageId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    public function isOpen(): bool
    {
        return $this->isOpen;
    }

    public function setIsOpen(bool $isOpen): void
    {
        $this->isOpen = $isOpen;
    }

    public function getDeal(): int
    {
        return $this->deal;
    }

    public function setDeal(int $deal): void
    {
        $this->deal = $deal;
    }

    public function getEntityTypeId(): int
    {
        return $this->entityTypeId;
    }

    public function setEntityTypeId(int $entityTypeId): void
    {
        $this->entityTypeId = $entityTypeId;
    }

    public function getSum(): int
    {
        return $this->sum;
    }

    public function setSum(int $sum): void
    {
        $this->sum = $sum;
    }



    public function getCustomFields(): array
    {
        return $this->customFields;
    }

    public function setCustomFields(array $customFields): void
    {
        $this->customFields = $customFields;
    }

    public function getContact(): int
    {
        return $this->contact;
    }

    public function setContact(int $contact): void
    {
        $this->contact = $contact;
    }

    public function getStageId(): string
    {
        return $this->stageId;
    }

    public function setStageId(string $stageId): void
    {
        $this->stageId = $stageId;
    }




}