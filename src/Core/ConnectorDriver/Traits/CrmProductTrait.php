<?php

namespace Debishev\Bitrix24Library\Core\ConnectorDriver\Traits;



use Debishev\Bitrix24Library\Core\Entity\CrmDeal;
use Debishev\Bitrix24Library\Core\Entity\CrmEntityProduct;
use Debishev\Bitrix24Library\Core\Entity\CrmProduct;
use Debishev\Bitrix24Library\Core\Enum\Bitrix24CrmEntityProductOwnerTypeEnum;

trait CrmProductTrait
{



    public function getProductById(int $id): mixed
    {
        $res = $this->getOneItem('crm.product.get',['ID' => $id]);
        return new CrmProduct($res);
    }

    public function getProductListByCrmEntityId(int $dealId, string $typeHex): array
    {
        $list = [];
        $res = $this->getList('crm.item.productrow.list',[
            'filter' => [
                '=ownerType' => $typeHex,
                '=ownerId' => $dealId,
            ]
        ]);
        $res = iterator_to_array($res, false)[0];
        foreach ($res['productRows'] as $item) {
            $list [] = new CrmEntityProduct($item);
        }
        return $list;
    }

    public function getProductsList(array $filter): array
    {
        $list = [];
        $res = $this->fetchList('crm.product.list', [
            'filter' => $filter
        ]);
        $res = iterator_to_array($res, false)[0];
        foreach ($res as $item) {
            $list [] = new CrmProduct($item);
        }
        return $list;
    }

}