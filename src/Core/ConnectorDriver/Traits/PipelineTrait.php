<?php

namespace Debishev\Bitrix24Library\Core\ConnectorDriver\Traits;

trait PipelineTrait
{


    public function getPipelines(): array
    {
        $list = [];
        $pipelines =  $this->getList('crm.category.list',['entityTypeId' => 2]);
        $result = iterator_to_array($pipelines,false);


        foreach ($result[0]['categories'] as $pipeline) {
            $newPipeline = $this->crmBitrixMapper->mapOneCrmPipeline($pipeline);


            $stages = $this->getList('crm.dealcategory.stage.list', ['ID' =>$newPipeline->getId() ]);
            $resultStages = iterator_to_array($stages,false);


            foreach ($resultStages as $resStage) {
                foreach ($resStage as $stage) {
                    $newPipeline->addStage($this->crmBitrixMapper->mapOneCrmPipelineStage($stage));
                }
            }


            $list[] = $newPipeline;

        }





        return $list;
    }

}