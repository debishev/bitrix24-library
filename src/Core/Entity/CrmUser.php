<?php

declare(strict_types=1);

namespace Debishev\Bitrix24Library\Core\Entity;


use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Security\Core\User\UserInterface;

class CrmUser implements UserInterface
{
    private ?int $id = null;
    private ?string $email = null;
    private ?string $lastname = '';
    private ?string $name = 'Не указано';
    private ?string $secondName = '';

    private string $avatar = '';

    private array $customFields = [];

    private bool $isCustomer = false;

    private array $departments = [];



    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }




    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getCustomFields(): array
    {
        return $this->customFields;
    }

    public function setCustomFields(array $customFields): void
    {
        $this->customFields = $customFields;
    }


    public function getRoles(): array
    {
        return ['USER_ROLE','ROLE_EMPLOYEE'];
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->getEmail() ?? '';
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function isIsCustomer(): bool
    {
        return $this->email == 'support@debishev.net';
    }

    public function setIsCustomer(bool $isCustomer): void
    {
        $this->isCustomer = $isCustomer;
    }


    public function getFIO(): string {
        return $this->lastname . ' ' . $this->name.' '.$this->secondName;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getSecondName(): ?string
    {
        return $this->secondName;
    }

    public function setSecondName(?string $secondName): void
    {
        $this->secondName = $secondName;
    }

    public function getDepartments(): array
    {
        return $this->departments;
    }

    public function setDepartments(array $departments): void
    {
        $this->departments = $departments;
    }



}
