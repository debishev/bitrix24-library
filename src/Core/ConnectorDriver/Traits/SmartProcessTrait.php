<?php


namespace Debishev\Bitrix24Library\Core\ConnectorDriver\Traits;


use Debishev\Bitrix24Library\Core\Entity\CrmSmartProcess;

trait SmartProcessTrait {

    public function getDealSmartProcessList(string $typeHexId, int $ownerId, array $filter, array $order): array
    {
        $filter['parentId2'] = $ownerId;
        $res = $this->getList('crm.item.list',[
            'entityTypeId' => $typeHexId,
            'filter' => $filter,
            'order' => $order,
        ]);

        $res = iterator_to_array($res, false);


        $list = $this->crmBitrixMapper
            ->mapGeneratorToArray(
                $res[0]['items'],
                fn($rawData)=> $this->crmBitrixMapper->mapOneCrmSmartProcess($rawData)
            );




        return $list;
    }



    public function getSmartProcessList(string $typeHexId, array $filter, array $order): array
    {
        $list = [];

        $res = $this->getList('crm.item.list',[
            'entityTypeId' => $typeHexId,
            'filter' => $filter,
            'order' => $order,
        ]);

        $res = iterator_to_array($res, false);


        foreach ($res as $items) {
            foreach ($items['items'] as $item) {
                $list[] = $item;
            }
        }


        $list = $this->crmBitrixMapper
            ->mapGeneratorToArray(
                $list,
                fn($rawData)=> $this->crmBitrixMapper->mapOneCrmSmartProcess($rawData)
            );




        return $list;
    }

    public function addSmartProcess(CrmSmartProcess $item): mixed {

        $fields = $this->crmBitrixMapper->mapOneToBitrixSmartProcess($item);
        return $this->request('crm.item.add',[
            'entityTypeId' => $item->getEntityTypeId(),
            'fields' => $fields
        ],
        );
    }
    public function getSmartProcessById(int $typeId, int $factId): CrmSmartProcess {


        $res =  $this->request('crm.item.get',[
            'entityTypeId' => $typeId,
            'id' => $factId
        ],
        );


        $res = iterator_to_array($res, false);


        return $this->crmBitrixMapper->mapOneCrmSmartProcess($res[0]);
    }



    public function deleteSmartProcess(int $entityTypeId, int $planId): mixed {


        return $this->request('crm.item.delete',[
            'entityTypeId' => $entityTypeId,
            'id' => $planId
        ],
        );
    }

    public function updatePaymentPlan(CrmSmartProcess $smartProcess): mixed {

        $fields = $this->crmBitrixMapper->mapOneToBitrixSmartProcess($smartProcess);
        return $this->request('crm.item.update',[
            'entityTypeId' => $smartProcess->getEntityTypeId(),
            'id' => $smartProcess->getId(),
            'fields' => $fields
        ],
        );
    }

}