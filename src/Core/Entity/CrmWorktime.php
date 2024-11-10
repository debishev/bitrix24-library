<?php

declare(strict_types=1);

namespace Debishev\Bitrix24Library\Core\Entity;

use DateTimeImmutable;

class CrmWorktime
{
    const STATUS_WORKING = 1;
    private string $status;
    private DateTimeImmutable $timeStart;
    private DateTimeImmutable $timeFinish;
    private bool $isActive;
    private string $timeFiesta;

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getTimeStart(): DateTimeImmutable
    {
        return $this->timeStart;
    }

    public function setTimeStart(DateTimeImmutable $timeStart): void
    {
        $this->timeStart = $timeStart;
    }

    public function getTimeFinish(): DateTimeImmutable
    {
        return $this->timeFinish;
    }

    public function setTimeFinish(DateTimeImmutable $timeFinish): void
    {
        $this->timeFinish = $timeFinish;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function getTimeFiesta(): string
    {
        return $this->timeFiesta;
    }

    public function setTimeFiesta(string $timeFiesta): void
    {
        $this->timeFiesta = $timeFiesta;
    }



    public function getRealStatus(): string
    {
        return match ($this->status) {
            'CLOSED' => 'не работает',
            'OPENED' => 'работает',
            'PAUSED' => 'перерыв',
            'EXPIRED' => 'истек',
        };
    }
}
