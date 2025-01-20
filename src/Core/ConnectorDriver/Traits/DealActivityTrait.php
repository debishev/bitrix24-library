<?php

namespace Debishev\Bitrix24Library\Core\ConnectorDriver\Traits;

use Debishev\Bitrix24Library\Core\Entity\CrmActivity;

trait DealActivityTrait
{
    public function getDealActivityList(array $filter = [], array $select = [], array $order = []): array
    {
        $list = [];
        $params = [
            'order'  => $order,
            'filter' => $filter,
            'select' => $select
        ];
        $res = $this->fetchList('crm.activity.list',$params);
        $res = iterator_to_array($res, false)['0'];

        foreach ($res as $item) {
            $list[] = new CrmActivity($item);
        };


        return $list;
    }


    public function addActivity(array $fields): int
    {
        $result = $this->request( 'crm.activity.add',
            [
                'fields' => $fields
            ]);
        return (int) $result;
    }


    public function deleteActivity(int $taskId): void
    {
        $this->request('crm.activity.delete',
            [
                'id' => $taskId
            ]
        );
    }

}