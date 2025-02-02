<?php

namespace Debishev\Bitrix24Library\Core\ConnectorDriver\Traits;

use Debishev\Bitrix24Library\Core\Entity\CrmDealContact;

trait ContactTrait
{
    public function getContactById(int $id): CrmDealContact
    {
        $res = $this->getOneItem('crm.contact.get',['ID' => $id]);

        return new CrmDealContact($res['result']);
    }



}