<?php

namespace Debishev\Bitrix24Library\Entity\MobileApp;



class Bitrix24LibraryTaskListModelResponse
{
    public function __construct(
        public string $nextScreen,
        public string $itemsTitle,
        public array $itemsActive = [],
        public array $itemsIssue = [],
    )
    { }


    function toArray(): array {
        return [
            'nextScreen' => $this->nextScreen,
            'params' => [
                'itemsTitle' => $this->itemsTitle,
                'itemsActive' => $this->itemsActive,
                'itemsIssue' => $this->itemsIssue,
            ]
        ];
    }
}