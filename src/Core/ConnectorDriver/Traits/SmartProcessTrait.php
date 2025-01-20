<?php


namespace Debishev\Bitrix24Library\Core\ConnectorDriver\Traits;


use Debishev\Bitrix24Library\Core\Entity\CrmSmartProcess;

trait SmartProcessTrait {


    public function getSmartProcessList(string $typeId, array $filter, array $order): array
    {
        $list = [];
        $res = $this->fetchList('crm.item.list',[
            'entityTypeId' => $typeId,
            'filter' => $filter,
            'order' => $order,
        ]);

        $items = iterator_to_array($res, false)[0]['items'];
        foreach ($items as $item) {
            $list[] = new CrmSmartProcess($item);
        }
        return $list;
    }


    public function getSmartProcessById(int $typeId, int $factId): CrmSmartProcess {
        $res =  $this->getOneItem('crm.item.get',[
            'entityTypeId' => $typeId,
            'id' => $factId
        ]);

        return new CrmSmartProcess($res);
    }


    public function addSmartProcess(string $entityTypeId, array $fields): CrmSmartProcess {

        $result = $this->request('crm.item.add',[
            'entityTypeId' => $entityTypeId,
            'fields' => $fields
        ]);
        $res = $result['item'];
        return new CrmSmartProcess($res);
    }

    public function deleteSmartProcess(int $typeId, int $id): void {
        $this->request('crm.item.delete',[
            'entityTypeId' => $typeId,
            'id' => $id
        ]);
    }


}