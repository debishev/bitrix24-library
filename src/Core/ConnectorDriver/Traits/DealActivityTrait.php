<?php

namespace Debishev\Bitrix24Library\Core\ConnectorDriver\Traits;

use Debishev\Bitrix24Library\Core\Entity\CrmTask;

trait DealActivityTrait
{
    public function getDealActivityList(array $filter = [], array $select = [], array $order = []): array
    {
        $params = [
            'order'  => $order,
            'filter' => $filter,
            'select' => $select
        ];
        $res = $this->getList('crm.activity.list',$params);

        $res = iterator_to_array($res, false);


        $list = $this->crmBitrixMapper
            ->mapGeneratorToArray(
                $res[0],
                fn($rawData)=> $this->crmBitrixMapper->mapOneCrmTask($rawData)
            );




        return $list;
    }


    public function addActivity(CrmTask $task): mixed
    {
        $fields = $this->crmBitrixMapper->mapOneToBitrixActivity($task);

        $result = $this->request(
            'crm.activity.add',
            [
                'fields' => $fields
            ]
        );

        return $result;
    }


    public function deleteDealCrmTask(int $taskId): mixed
    {

        $result = $this->request(
            'crm.activity.delete',
            [
                'id' => $taskId
            ]
        );

        return $result;
    }

}