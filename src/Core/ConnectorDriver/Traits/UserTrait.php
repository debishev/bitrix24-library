<?php

namespace Debishev\Bitrix24Library\Core\ConnectorDriver\Traits;

use Debishev\Bitrix24Library\Core\ConnectorDriver\CrmFilter\CRMUserFilter;
use Debishev\Bitrix24Library\Core\Entity\CrmProfile;
use Debishev\Bitrix24Library\Core\Entity\CrmUser;
use Debishev\Bitrix24Library\Core\Enum\UserCustomFieldType;

trait UserTrait
{
    public function getUser(CRMUserFilter $filter): ?CrmUser
    {

        $users = $this->crmBitrixMapper
            ->mapGeneratorToArray(
                $this->getList('user.get',$filter->toArray()),
                fn($rawData)=> $this->crmBitrixMapper->mapOneCrmUser($rawData)
            );


        if(count($users) > 0) {
            $user = $users[0];
            $profile = $this->getProfile($user->getId());
            $user->setAvatar($profile->getAvatar());
        }

        return count($users) > 0 ? $users[0] : null;

    }



    public function getUserById(int $id): ?CrmUser
    {

        $users = $this->crmBitrixMapper
            ->mapGeneratorToArray(
                $this->getList('user.get',['ID' => $id]),
                fn($rawData)=> $this->crmBitrixMapper->mapOneCrmUser($rawData)
            );


        if(count($users) > 0) {
            $user = $users[0];
            $profile = $this->getProfile($user->getId());
            $user->setAvatar($profile->getAvatar());
        }

        return count($users) > 0 ? $users[0] : null;

    }

    public function getCurrentUserByAuth(string $authKey): ?CrmUser
    {
        $res = $this->requestByAuth('user.current',[], $authKey);
        $user = $this->crmBitrixMapper->mapOneCrmUser($res);
        $profile = $this->getProfile($user->getId());
        $user->setAvatar($profile->getAvatar());

        return $user;
    }

    public function getProfile(int $id): CrmProfile
    {
        return $this->crmBitrixMapper->mapOneCrmProfile(
            $this->request('user.get',["ID" => $id])[0]
        );

    }


    public function updateUser(int $id, array $fields): mixed
    {
        $fields['ID'] = $id;
        return $this->request('user.update',$fields);
    }
    public function addCustomUserField(string $fieldId, UserCustomFieldType $fieldType): mixed
    {
        return $this->request('user.userfield.add', ['fields[FIELD_NAME]' => $fieldId, 'fields[USER_TYPE_ID]' => $fieldType->value]);
    }
    public function notifyUser(int $userId, string $txt): void
    {
        $this->request('im.notify.personal.add', [
            'USER_ID' => $userId,
            'MESSAGE' => $txt,
        ]);
    }

    public function getDepartmentUsers(int $departmentId): array
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