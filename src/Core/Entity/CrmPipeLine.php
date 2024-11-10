<?php

namespace Debishev\Bitrix24Library\Core\Entity;

class CrmPipeLine
{
    private int $id;
    private string $name;
    private int $sort;
    private array $stages = [];

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

    public function getSort(): int
    {
        return $this->sort;
    }

    public function setSort(int $sort): void
    {
        $this->sort = $sort;
    }

    public function getStages(): array
    {
        return $this->stages;
    }

    public function addStage(CrmPipelineStage $stage): void
    {
        $this->stages [] = $stage;
    }

    public function removeStage(CrmPipelineStage $stage): void
    {
        unset($this->stages [array_search($stage, $this->stages)]);
    }



}