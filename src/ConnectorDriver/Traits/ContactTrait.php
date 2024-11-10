<?php

namespace Debishev\Bitrix24Library\ConnectorDriver\Traits;

use Debishev\Bitrix24Library\Entity\CrmDealContact;

trait ContactTrait
{
    public function getContact(int $id): ?CrmDealContact
    {
        return  $this->crmBitrixMapper->mapOneCrmDealContact($this->getOneItem('crm.contact.get',['ID' => $id]));
    }



}