<?php


namespace Debishev\Bitrix24Library\Core\ConnectorDriver\Traits;


use Debishev\Bitrix24Library\Core\Entity\CrmCompany;

trait CompanyTrait {
    public function getCompanyById(int $id): CrmCompany {

        $res = $this->getOneItem('crm.company.get',[
            'ID' => $id
        ]);

       return new CrmCompany($res);
    }

}