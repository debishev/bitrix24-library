<?php

namespace Debishev\Bitrix24Library\DataMappers;





use Debishev\Bitrix24Library\Entity\CrmCompany;
use Debishev\Bitrix24Library\Entity\CrmDeal;
use Debishev\Bitrix24Library\Entity\CrmDealContact;
use Debishev\Bitrix24Library\Entity\CrmEntity;
use Debishev\Bitrix24Library\Entity\CrmProfile;
use Debishev\Bitrix24Library\Entity\CrmSmartProcess;
use Debishev\Bitrix24Library\Entity\CrmTask;
use Debishev\Bitrix24Library\Entity\CrmUser;

class CRMBaseMapper implements CRMBaseMapperInterface
{

    public function mapGeneratorToArray(array|\Generator $generator, $mapFunction): array
    {


        $list = [];
        if (gettype($generator) == 'array') {
            foreach ($generator as $res) {
                $list [] = $mapFunction($res);
            }
        } elseif ($generator::class == \Generator::class) {
            $result = iterator_to_array($generator, false);


            foreach ($result as $res) {
                foreach ($res as $res1) {
                    $list [] = $mapFunction($res1);
                }
            }
        }
        return $list;
    }


    public function mapOneCrmEntity(array $rawData): CrmEntity
    {
        throw new \Exception("Not implemented");
    }

    public function mapOneCrmUser(array $rawData): CrmUser
    {
        throw new \Exception("Not implemented");
    }

    public function mapOneCrmProfile(array $rawData): CrmProfile
    {
        throw new \Exception("Not implemented");
    }


    public function mapOneCrmSmartProcess(array $rawData): CrmSmartProcess
    {
        throw new \Exception("Not implemented");
    }

    public function mapOneCrmDeal(array $rawData): CrmDeal
    {
        throw new \Exception("Not implemented");
    }

    public function mapOneToBitrixSmartProcess(CrmSmartProcess $item): array
    {
        throw new \Exception("Not implemented");
    }

    public function mapOneToBitrixDeal(CrmDeal $item): array
    {
        throw new \Exception("Not implemented");
    }

    public function mapOneCrmTask(array $rawData): CrmTask
    {
        throw new \Exception("Not implemented");
    }

    public function mapOneToBitrixActivity( CrmTask $task): array
    {
        throw new \Exception("Not implemented");
    }

    public function mapOneCrmDealContact(array $rawData): CrmDealContact
    {
        throw new \Exception("Not implemented");
    }

    public function mapOneCrmCompany(array $rawData): CrmCompany
    {
        throw new \Exception("Not implemented");
    }
}
