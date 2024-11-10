<?php

namespace Debishev\Bitrix24Library\Core\ConnectorDriver\Traits;

use DateTimeImmutable;
use Debishev\Bitrix24Library\Core\Entity\CrmDeal;

trait DealTrait
{
    public function getDeal(int $id): ?CrmDeal
    {
        return  $this->crmBitrixMapper->mapOneCrmDeal($this->getOneItem('crm.deal.get',['ID' => $id]));
    }
    public function updateDeal(CrmDeal $deal): mixed
    {
        $fields = $this->crmBitrixMapper->mapOneToBitrixDeal($deal);
        return $this->request('crm.deal.update',[
            'id' => $deal->getId(),
            'fields' => $fields
        ],
        );
    }


    public function moveDealToStage(int $dealId, string $stageId): mixed
    {

        return $this->request('crm.deal.update',[
            'id' => $dealId,
            'fields' => [
                'STAGE_ID' => $stageId
            ]
        ],
        );
    }


    public function getDeals(array $filter): array
    {
        $list = [];
        $res = $this->getList('crm.deal.list',[
            'select' => ['UF_*','*'],
            'filter' => $filter,
            'order' => [],
        ]);

        $res = iterator_to_array($res, false);

        foreach ($res as $items) {
            foreach ($items as $item) {
                $list[] = $item;
            }
        }

        $list = $this->crmBitrixMapper
            ->mapGeneratorToArray(
                $list,
                fn($rawData)=> $this->crmBitrixMapper->mapOneCrmDeal($rawData)
            );




        return $list;
    }


    public function getDealsHistoryByStageInPeriod(string $stage): array
    {
        $list = [];
        $res = $this->getList('crm.stagehistory.list',[
//            'select' => ['UF_*','*'],
            'entityTypeId' => 2,
            'filter' => [
//                'STAGE_ID' => $stage,
            ]
        ]);

        $res = iterator_to_array($res, false);

        foreach ($res as $items) {
            foreach ($items['items'] as $item) {

                $item['CREATED_TIME']  = DateTimeImmutable::createFromFormat(DATE_ATOM, $item['CREATED_TIME']);

                $list[] = $item;
            }
        }


        return $list;
    }

    public function dealAddNewComment(int $dealId, string $txt): void
    {
        $fields = [
            'ENTITY_ID' => $dealId,
            'ENTITY_TYPE' => 'deal',
            'COMMENT' => $txt,
        ];
        $this->request('crm.timeline.comment.add',[
            'fields' => $fields
        ],
        );
    }

}