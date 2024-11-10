<?php

declare(strict_types=1);

namespace Debishev\Bitrix24Library\Core\Entity;


use Symfony\Component\Security\Core\User\UserInterface;

class CrmProfile
{
    private ?int $id = null;
    private ?string $avatar = null;

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar;
    }




}
