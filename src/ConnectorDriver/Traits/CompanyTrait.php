<?php


namespace Debishev\Bitrix24Library\ConnectorDriver\Traits;


use Debishev\Bitrix24Library\Entity\CrmCompany;

trait CompanyTrait {
    public function getCompanyById(int $id): CrmCompany {



        $res =  $this->request('crm.company.get',[
            'ID' => $id
        ],
        );





        return $this->crmBitrixMapper->mapOneCrmCompany($res);
    }

}