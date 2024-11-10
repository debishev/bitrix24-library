<?php

namespace Debishev\Bitrix24Library\Core\RequestMapper;

use Symfony\Component\Validator\Constraints as Assert;

class CommentTaskRequestMapper
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 1, max: 1000)]
        public readonly mixed $text,

        #[Assert\NotBlank]
        #[Assert\Positive]
        public readonly int $task,

    ) {
    }
}