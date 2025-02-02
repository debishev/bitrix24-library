<?php


namespace Debishev\Bitrix24Library\Core\ConnectorDriver\Traits;


use Debishev\Bitrix24Library\Core\Entity\CrmSmartProcess;

trait SmartProcessTrait {


    public function getSmartProcessList(string $typeId, array $filter, array $order): array
    {
        $list = [];
        $items = $this->fetchList('crm.item.list',[
            'entityTypeId' => $typeId,
            'filter' => $filter,
            'order' => $order,
        ]);

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
        $res = $result['result']['item'];
        return new CrmSmartProcess($res);
    }

    public function deleteSmartProcess(int $typeId, int $id): void {
        $this->request('crm.item.delete',[
            'entityTypeId' => $typeId,
            'id' => $id
        ]);
    }

    public function attachProductsToSmartProcess(string $entityHexTypeId, int $itemId, array $products ): void {

        $exProducts = [];

        foreach ($products as $product) {
            $exProducts [] = [
                'ownerType' => $entityHexTypeId,
                'ownerId' => $itemId,
                'productId' => $product['productId'],
                'price' => $product['price'],
                'quantity' => $product['quantity'],
            ];
        }

        $this->request('crm.item.productrow.set', [
            'ownerType' => $entityHexTypeId,
            'ownerId' => $itemId,
            'productRows' => $exProducts,
        ]);
    }


}