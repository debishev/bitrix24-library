<?php

declare(strict_types=1);

namespace Debishev\Bitrix24Library\Core\Entity;


use DateTimeImmutable;

class CrmTask
{
    private ?int $id = null;
    private string $title;

    private DateTimeImmutable $startDate;

    private int $assignToUser = 0;
    private int $contactId = 0;

    private int $assignToDealId = 0;

    private bool $isCompleted = false;

    private array $accomplices = [];

    private string $description = '';

    private DateTimeImmutable $deadline;
    private DateTimeImmutable $endtime;

    private string $provider = 'none';

    private int $dealId;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getStartDate(): DateTimeImmutable
    {
        return $this->startDate;
    }



    public function getSimpleStartDate(): string
    {
        return $this->startDate->format('Y-m-d').'T19:00:00+03:00';
    }

    public function setStartDate(DateTimeImmutable $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getAssignToUser(): int
    {
        return $this->assignToUser;
    }

    public function setAssignToUser(int $assignToUser): void
    {
        $this->assignToUser = $assignToUser;
    }

    public function getAssignToDealId(): int
    {
        return $this->assignToDealId;
    }

    public function setAssignToDealId(int $assignToDealId): void
    {
        $this->assignToDealId = $assignToDealId;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getAccomplices(): array
    {
        return $this->accomplices;
    }

    public function setAccomplices(array $accomplices): void
    {
        $this->accomplices = $accomplices;
    }

    public function getContactId(): int
    {
        return $this->contactId;
    }

    public function setContactId(int $contactId): void
    {
        $this->contactId = $contactId;
    }

    public function isCompleted(): bool
    {
        return $this->isCompleted;
    }

    public function setIsCompleted(bool $isCompleted): void
    {
        $this->isCompleted = $isCompleted;
    }

    public function getDeadline(): DateTimeImmutable
    {
        return $this->deadline;
    }

    public function setDeadline(DateTimeImmutable $deadline): void
    {
        $this->deadline = $deadline;
    }

    public function getProvider(): string
    {
        return $this->provider;
    }

    public function setProvider(string $provider): void
    {
        $this->provider = $provider;
    }

    public function getEndtime(): DateTimeImmutable
    {
        return $this->endtime;
    }

    public function setEndtime(DateTimeImmutable $endtime): void
    {
        $this->endtime = $endtime;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getFormattedDeadline(): string
    {
        return '10 минут назад';
    }

    public function getDealId(): int
    {
        return $this->dealId;
    }

    public function setDealId(int $dealId): void
    {
        $this->dealId = $dealId;
    }



}