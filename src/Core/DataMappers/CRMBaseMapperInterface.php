<?php

namespace Debishev\Bitrix24Library\Core\DataMappers;



use Debishev\Bitrix24Library\Core\Entity\CrmCompany;
use Debishev\Bitrix24Library\Core\Entity\CrmDeal;
use Debishev\Bitrix24Library\Core\Entity\CrmDealContact;
use Debishev\Bitrix24Library\Core\Entity\CrmEntity;
use Debishev\Bitrix24Library\Core\Entity\CrmProfile;
use Debishev\Bitrix24Library\Core\Entity\CrmSmartProcess;
use Debishev\Bitrix24Library\Core\Entity\CrmTask;
use Debishev\Bitrix24Library\Core\Entity\CrmUser;

interface CRMBaseMapperInterface
{
    public function mapOneCrmEntity(array $rawData): CrmEntity;
    public function mapOneCrmUser(array $rawData): CrmUser;
    public function mapOneCrmDealContact(array $rawData): CrmDealContact;
    public function mapOneCrmDeal(array $rawData): CrmDeal;
    public function mapOneCrmProfile(array $rawData): CrmProfile;
    public function mapOneCrmSmartProcess(array $rawData): CrmSmartProcess;
    public function mapOneCrmTask(array $rawData): CrmTask;

    public function mapOneToBitrixSmartProcess(CRMSmartProcess $item): array;
    public function mapOneToBitrixDeal(CrmDeal $item): array;
    public function mapOneToBitrixActivity( CrmTask $task): array;

    public function mapOneCrmCompany(array $rawData): CrmCompany;

}