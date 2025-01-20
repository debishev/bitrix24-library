<?php

namespace Debishev\Bitrix24Library\Core\ConnectorDriver\Traits;


use Debishev\Bitrix24Library\Core\Entity\CrmUser;
use Debishev\Bitrix24Library\Core\Enum\Bitrix24UserCustomFieldType;

trait UserTrait
{

    public function getUserById(int $id): ?CrmUser
    {
        $res = $this->getOneItem('user.get',[
            'ID' => $id,
        ])[0];

        return  new CrmUser($res);
    }



    public function getUserByEmail(string $email): ?CrmUser
    {
        $res = $this->getList('user.get',[
            'FILTER[EMAIL]' => $email,
        ]);
        $res = iterator_to_array($res, false)[0]['result'];

        return count($res) > 0 ?  new CrmUser($res[0]) : null;
    }



    public function getCurrentUserByAuth(string $authKey): ?CrmUser
    {
        $res = $this->requestByAuth('user.current',[], $authKey);
        $user = $this->crmBitrixMapper->mapOneCrmUser($res);
        $profile = $this->getProfile($user->getId());
        $user->setAvatar($profile->getAvatar());

        return $user;
    }




    public function updateUser(int $id, array $fields): bool
    {
        $fields['ID'] = $id;
        $res =  $this->request('user.update',$fields);

        return (bool) json_decode($res, true)['result'];
    }




    public function addCustomUserField(string $title ,string $fieldId, Bitrix24UserCustomFieldType $fieldType): int
    {
        $res =  $this->request('user.userfield.add', [
            'fields[LABEL]' => $title,
            'fields[FIELD_NAME]' => $fieldId,
            'fields[USER_TYPE_ID]' => $fieldType->value
        ]);

        return (int) json_decode($res, true)['result'];
    }


    public function notifyUser(int $userId, string $txt): int
    {
        $res = $this->request('im.notify.personal.add', [
            'USER_ID' => $userId,
            'MESSAGE' => $txt,
        ]);

        return (int) json_decode($res, true)['result'];
    }


    public function getUsersByDepartmentId(int $departmentId): array
    {
        $list = [];
        $pipelines =  $this->getList('timeman.timecontrol.reports.users.get',['DEPARTMENT_ID' => $departmentId]);
        $result = iterator_to_array($pipelines,false);


        foreach ($result[0] as $employee) {
            $user = $this->getUserById($employee['id']);
            $list[] = $user;
        }

        return $list;
    }
}