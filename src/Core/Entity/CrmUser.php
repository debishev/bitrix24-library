<?php

declare(strict_types=1);

namespace Debishev\Bitrix24Library\Core\Entity;



use DateTimeImmutable;
use Debishev\Bitrix24Library\Core\Entity\Traits\EntityFieldsTrait;
use Symfony\Component\Security\Core\User\UserInterface;

class CrmUser implements UserInterface
{

    use EntityFieldsTrait;

    public ?string $ID;
    public ?string $XML_ID;
    public bool $ACTIVE;
    public ?string $NAME;
    public ?string $LAST_NAME;
    public ?string $SECOND_NAME;
    public ?string $EMAIL;
    public ?DateTimeImmutable $LAST_LOGIN;
    public DateTimeImmutable $DATE_REGISTER;
    public ?string $TIME_ZONE;
    public ?string $IS_ONLINE;
    public ?string $TIME_ZONE_OFFSET;
    public array $TIMESTAMP_X;
    public array $LAST_ACTIVITY_DATE;
    public ?string $PERSONAL_GENDER;
    public ?string $PERSONAL_WWW;
    public ?string $PERSONAL_BIRTHDAY;
    public ?string $PERSONAL_PHOTO;
    public ?string $PERSONAL_MOBILE;
    public ?string $PERSONAL_CITY;
    public ?string $WORK_PHONE;
    public ?string $WORK_POSITION;
    public ?string $UF_EMPLOYMENT_DATE;

    /** @var array<int> */
    public array $UF_DEPARTMENT;

    public ?string $UF_PHONE_INNER;
    public ?string $USER_TYPE;

    public array $customFields = [];


    public function __construct(array $data = [])
    {
        $this->fillData($data);
    }

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials(): void
    {

    }

    public function getUserIdentifier(): string
    {
        return $this->EMAIL;
    }
}
