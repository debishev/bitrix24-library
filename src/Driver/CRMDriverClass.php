<?php

namespace Debishev\Bitrix24Library\Driver;



use Debishev\Bitrix24Library\Connector\CRMConnectorClass;
use Debishev\Bitrix24Library\ConnectorDriver\CrmFilter\CRMUserFilter;
use Debishev\Bitrix24Library\Entity\CrmCompany;
use Debishev\Bitrix24Library\Entity\CrmDeal;
use Debishev\Bitrix24Library\Entity\CrmDealContact;
use Debishev\Bitrix24Library\Entity\CrmProfile;
use Debishev\Bitrix24Library\Entity\CrmSmartProcess;
use Debishev\Bitrix24Library\Entity\CrmTask;
use Debishev\Bitrix24Library\Entity\CrmUser;
use Debishev\Bitrix24Library\Enum\UserCustomFieldType;


class CRMDriverClass
{



    public function __construct(
        private readonly CRMConnectorClass $crmConnector
    )
    { }


    public function getUser(CRMUserFilter $filter): ?CrmUser
    {
        return $this->crmConnector->getUser($filter);
    }

    public function getCurrentUserByAuth(string $authKey): CrmUser
    {
        return $this->crmConnector->getCurrentUserByAuth($authKey);
    }

    public function getDeal(int $dealId): ?CrmDeal
    {
        return $this->crmConnector->getDeal($dealId);
    }

    public function getContactById(int $id): ?CrmDealContact
    {
        return $this->crmConnector->getContactById($id);
    }

    public function getCompanyById(int $id): CrmCompany
    {
        return $this->crmConnector->getCompanyById($id);
    }

    public function getDeals(array $filter): array
    {
        return $this->crmConnector->getDeals($filter);
    }

    public function getDealsHistoryByStageInPeriod(string $stage): array
    {
        return $this->crmConnector->getDealsHistoryByStageInPeriod($stage);
    }

    public function getDealSmartProcessList(string $typeHexId, int $dealId, array $filter, array $order): array
    {
        return $this->crmConnector->getDealSmartProcessList($typeHexId, $dealId, $filter, $order);
    }

    public function updateUser(int $id, array $fields): mixed
    {
        return $this->crmConnector->updateUser($id, $fields);
    }

    public function addCustomUserField(string $fieldId, UserCustomFieldType $fieldType): ?CrmUser
    {
        return $this->crmConnector->addCustomUserField($fieldId, $fieldType);
    }

    public function getUserById(int $id): ?CrmUser
    {
        return $this->crmConnector->getUserById($id);
    }

    public function getProfile(int $id): CrmProfile
    {
        return $this->crmConnector->getProfile($id);
    }

    public function addSmartProcess(CrmSmartProcess $item): mixed
    {
        return $this->crmConnector->addSmartProcess($item);
    }

    public function getSmartProcessById(int $typeId, int $factId): CrmSmartProcess
    {
        return $this->crmConnector->getSmartProcessById($typeId, $factId);
    }

    public function getSmartProcessList(int $typeId, array $filter, array $order): array
    {
        return $this->crmConnector->getSmartProcessList($typeId, $filter, $order);
    }

    public function updatePaymentPlan(CrmSmartProcess $smartProcess): mixed
    {
        return $this->crmConnector->updatePaymentPlan($smartProcess);
    }


    public function updateDeal(CrmDeal $deal): mixed
    {
        return $this->crmConnector->updateDeal($deal);
    }

    public function getDealCrmTasks(int $dealId): array
    {
        $filter = [
            'PROVIDER_ID' => 'CRM_TODO',
            'COMPLETED' => 'N',
            'OWNER_ID' => $dealId,
            'OWNER_TYPE_ID' => '2',
        ];
        return $this->crmConnector->getDealCrmTasks($filter);
    }


    public function deleteDealCrmTask(int $taskId): mixed
    {
        return $this->crmConnector->deleteDealCrmTask($taskId);
    }


    public function addDealCrmTask(CrmTask $task): mixed
    {
        return $this->crmConnector->addDealCrmTask($task);
    }




    public function deleteSmartProcess(string $typeHexId, int $planId): void
    {
        $this->crmConnector->deleteSmartProcess($typeHexId, $planId);
    }

    public function getPipelines(): array
    {
        return $this->crmConnector->getPipelines();
    }


    public function dealAddNewComment(int $dealId, string $txt): void
    {
        $this->crmConnector->dealAddNewComment($dealId, $txt);
    }

    public function moveDealToStage(int $dealId, string $stageId): mixed
    {
        return $this->crmConnector->moveDealToStage($dealId, $stageId);
    }
    public function notifyUser(int $userId, string $txt): void
    {
        $this->crmConnector->notifyUser($userId, $txt);
    }

    public function getDepartmentUsers(int $departmentId): array
    {
        return $this->crmConnector->getDepartmentUsers($departmentId);
    }

}
