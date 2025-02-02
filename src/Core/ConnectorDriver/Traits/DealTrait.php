<?php

namespace Debishev\Bitrix24Library\Core\ConnectorDriver\Traits;

use DateTimeImmutable;
use Debishev\Bitrix24Library\Core\Entity\CrmDeal;

trait DealTrait
{
    public function getDealById(int $id): ?CrmDeal
    {
        $result = $this->getOneItem('crm.deal.get',['ID' => $id]);
        return count($result['result']) > 0 ?  new CrmDeal($result['result']) : null;
    }
    public function updateDeal(string $id, array $fields): bool
    {
        $result =  $this->request('crm.deal.update',[
            'id' => $id,
            'fields' => $fields
        ]);

        return (bool) json_decode($result, true)['result'];

    }


    public function moveDealToStage(string $dealId, string $stageId): bool
    {
        return $this->updateDeal($dealId, ['STAGE_ID' => $stageId]);
    }


    public function getDeals(array $filter): array
    {
        $list = [];
        $res = $this->fetchList('crm.deal.list',[
            'select' => ['UF_*','*'],
            'filter' => $filter,
            'order' => [],
        ]);

        foreach ($res as $item) {
            $list [] = new CrmDeal($item);
        }


        return $list;
    }




    public function dealAddNewComment(int $dealId, string $txt): int
    {
        $fields = [
            'ENTITY_ID' => $dealId,
            'ENTITY_TYPE' => 'deal',
            'COMMENT' => $txt,
        ];
        $result = $this->request('crm.timeline.comment.add',[
            'fields' => $fields
        ]);

        return (int) $result['result'];
    }

}