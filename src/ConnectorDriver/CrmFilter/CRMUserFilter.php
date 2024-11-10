<?php

namespace Debishev\Bitrix24Library\ConnectorDriver\CrmFilter;

class CRMUserFilter extends BaseCRMFilter
{
    public ?string  $email = null;
    public ?string  $id = null;

    public function toArray(): array
    {
        $list = [];

        if(!empty($this->email)) {
            $list['email'] = $this->email;
        }

        if(!empty($this->id)) {
            $list['ID'] = $this->email;
        }


        return $list;
    }


}