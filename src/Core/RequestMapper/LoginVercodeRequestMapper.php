<?php

namespace Debishev\Bitrix24Library\Core\RequestMapper;

use Symfony\Component\Validator\Constraints as Assert;

class LoginVercodeRequestMapper
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
    ) {
    }
}