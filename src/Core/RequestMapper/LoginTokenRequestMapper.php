<?php

namespace Debishev\Bitrix24Library\Core\RequestMapper;

use Symfony\Component\Validator\Constraints as Assert;

class LoginTokenRequestMapper
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(
            min: 5,
            max: 100,
            minMessage: "Минимальная длина логина 5 символов",
            maxMessage: "Максимальная длина логина 100 символов"
        )]
        public readonly string $login,

        #[Assert\NotBlank]
        #[Assert\Length(
            min: 5,
            max: 6,
            minMessage: "Код проверки минимум 5 символов",
            maxMessage: "Код проверки максимум 6 символов"
        )]
        public readonly string $vercode,
    ) {
    }
}