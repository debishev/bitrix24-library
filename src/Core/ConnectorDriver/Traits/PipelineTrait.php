<?php

namespace Debishev\Bitrix24Library\Core\ConnectorDriver\Traits;

use Debishev\Bitrix24Library\Core\Entity\CrmPipeLine;

trait PipelineTrait
{




    public function getPipelines(): array
    {
        $list = [];
        $pipelines =  $this->getList('crm.category.list',['entityTypeId' => 2]);
        $result = json_decode(iterator_to_array($pipelines,false)[0], true);


        foreach ($result['result']['categories'] as $pipeline) {
            $pipeline = new CrmPipeline($pipeline);
            $pipeline->stages = $this->getPipeLineStages($pipeline->id);
            $list[] = $pipeline;
        }


        return $list;
    }



    public function getPipeLineStages(int $pipelineId): array
    {
        $stages = $this->getList('crm.dealcategory.stage.list', ['ID' => $pipelineId ]);
        $result = iterator_to_array($stages,false);


        return $result;
    }

}