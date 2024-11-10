<?php

namespace Debishev\Bitrix24Library\Core\Entity;

use DateTimeImmutable;

class CrmDealContact
{
    private int $id = 0;

    private string $name = '';
    private string $lastName = '';
    private string $secondName = '';

    private array $phones = [];

    private ?DateTimeImmutable $birthday = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getSecondName(): string
    {
        return $this->secondName;
    }

    public function setSecondName(string $secondName): void
    {
        $this->secondName = $secondName;
    }

    public function getPhones(): array
    {
        return $this->phones;
    }

    public function setPhones(array $phones): void
    {
        $this->phones = $phones;
    }

    public function getBirthday(): ?DateTimeImmutable
    {
        return $this->birthday;
    }

    public function setBirthday(?DateTimeImmutable $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getFIO(): string
    {
        return $this->getLastName() . ' ' . $this->getName() . ' ' . $this->getSecondName();
    }







}