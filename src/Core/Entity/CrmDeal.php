<?php

declare(strict_types=1);

namespace Debishev\Bitrix24Library\Core\Entity;



class CrmDeal
{
    private ?int $id = null;
    private ?string $title = null;
    private int  $sum ;
    private ?string $currency = null;

    private ?\DateTimeImmutable $date = null;

    private ?\DateTimeImmutable $closedAt = null;

    private int $responsibleUserId = 0;
    private int $contactId = 0;

    private array $customFields = [];

    private int $pipelineId = -1;

    private ?string $status = null;
    private bool $isClosed = false;

    private int $vendor = 0;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }




    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSum(): int
    {
        return $this->sum;
    }

    public function setSum(int $sum): void
    {
        $this->sum = $sum;
    }





    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getResponsibleUserId(): int
    {
        return $this->responsibleUserId;
    }

    public function setResponsibleUserId(int $responsibleUserId): void
    {
        $this->responsibleUserId = $responsibleUserId;
    }

    public function getCustomFields(): array
    {
        return $this->customFields;
    }

    public function setCustomFields(array $customFields): void
    {
        $this->customFields = $customFields;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(?\DateTimeImmutable $date): void
    {
        $this->date = $date;
    }

    public function getContactId(): int
    {
        return $this->contactId;
    }

    public function setContactId(int $contactId): void
    {
        $this->contactId = $contactId;
    }

    public function getPipelineId(): int
    {
        return $this->pipelineId;
    }

    public function setPipelineId(int $pipelineId): void
    {
        $this->pipelineId = $pipelineId;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function getClosedAt(): ?\DateTimeImmutable
    {
        return $this->closedAt;
    }

    public function setClosedAt(?\DateTimeImmutable $closedAt): void
    {
        $this->closedAt = $closedAt;
    }

    public function isClosed(): bool
    {
        return $this->isClosed;
    }

    public function setIsClosed(bool $isClosed): void
    {
        $this->isClosed = $isClosed;
    }


    public function getVendor(): int
    {
        return $this->vendor;
    }

    public function setVendor(int $vendor): void
    {
        $this->vendor = $vendor;
    }



}
