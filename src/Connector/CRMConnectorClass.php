<?php

namespace Debishev\Bitrix24Library\Connector;




use Debishev\Bitrix24Library\ConnectorDriver\Bitrix24ApiConnectorDriver;
use Debishev\Bitrix24Library\ConnectorDriver\CrmFilter\CRMUserFilter;
use Debishev\Bitrix24Library\Entity\CrmCompany;
use Debishev\Bitrix24Library\Entity\CrmDeal;
use Debishev\Bitrix24Library\Entity\CrmDealContact;
use Debishev\Bitrix24Library\Entity\CrmProfile;
use Debishev\Bitrix24Library\Entity\CrmSmartProcess;
use Debishev\Bitrix24Library\Entity\CrmTask;
use Debishev\Bitrix24Library\Entity\CrmUser;
use Debishev\Bitrix24Library\Enum\UserCustomFieldType;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;


class CRMConnectorClass
{

    const PAYMENT_TYPE_FULL = 45;
    const PAYMENT_TYPE_PART = 47;
    const PAYMENT_TYPE_DOLG = 49;
    const PAYMENT_TYPE_AFTER = 69;




    public string $webhookUrl = '';


    public function __construct(private readonly Bitrix24ApiConnectorDriver $bitrix24ApiConnector, ContainerBagInterface $containerBag)
    {
        $url = $containerBag->get('bx.webhook.url');
        $this->bitrix24ApiConnector->webhookUrl = 'https://domain.loc/rest/1/1234';
        $this->bitrix24ApiConnector->baseUrl = 'https://domain.locg/rest';
    }

    public function getWebhookUrl(): string
    {
        return $this->webhookUrl;
    }

    public function setWebhookUrl(string $webhookUrl): void
    {
        $this->webhookUrl = $webhookUrl;
        $this->bitrix24ApiConnector->webhookUrl = $webhookUrl;
    }


    public function getUser(CRMUserFilter $filter): ?CrmUser
    {
        return $this->bitrix24ApiConnector->getUser($filter);
    }

    public function getCurrentUserByAuth(string $authKey): CrmUser
    {
        return $this->bitrix24ApiConnector->getCurrentUserByAuth($authKey);
    }


    public function getDeal(int $dealId): ?CrmDeal
    {
        return $this->bitrix24ApiConnector->getDeal($dealId);
    }
    public function getContactById(int $id): ?CrmDealContact
    {
        return $this->bitrix24ApiConnector->getContact($id);
    }

    public function getCompanyById(int $id): CrmCompany
    {
        return $this->bitrix24ApiConnector->getCompanyById($id);
    }

    public function getDeals(array $filter): array
    {
        return $this->bitrix24ApiConnector->getDeals($filter);
    }

    public function getDealsHistoryByStageInPeriod(string $stage): array
    {
        return $this->bitrix24ApiConnector->getDealsHistoryByStageInPeriod($stage);
    }

    public function updateUser(int $id, array $fields): mixed
    {
        return $this->bitrix24ApiConnector->updateUser($id, $fields);
    }

    public function getUserById(int $id): ?CrmUser
    {
        return $this->bitrix24ApiConnector->getUserById($id);
    }

    public function getProfile(int $id): CrmProfile
    {
        return $this->bitrix24ApiConnector->getProfile($id);
    }


    public function addCustomUserField(string $fieldId, UserCustomFieldType $fieldType): mixed
    {
        return $this->bitrix24ApiConnector->addCustomUserField($fieldId, $fieldType);
    }

    public function getDealSmartProcessList(string $typeHexId, int $dealId, array $filter, array $order): array
    {
        return $this->bitrix24ApiConnector->getDealSmartProcessList($typeHexId, $dealId, $filter, $order);
    }
    public function addSmartProcess(CrmSmartProcess $item): mixed
    {
        return $this->bitrix24ApiConnector->addSmartProcess($item);
    }
    public function getSmartProcessById(int $typeId, int $factId): CrmSmartProcess
    {
        return $this->bitrix24ApiConnector->getSmartProcessById($typeId, $factId);
    }

    public function getSmartProcessList(int $typeId, array $filter, array $order): array
    {
        return $this->bitrix24ApiConnector->getSmartProcessList($typeId, $filter, $order);
    }

    public function updatePaymentPlan(CrmSmartProcess $smartProcess): mixed
    {
        return $this->bitrix24ApiConnector->updatePaymentPlan($smartProcess);
    }
    public function updateDeal(CrmDeal $deal): mixed
    {
        return $this->bitrix24ApiConnector->updateDeal($deal);
    }
    public function getDealCrmTasks(array $filter = [], array $select = [], array $order = []): array
    {
        return $this->bitrix24ApiConnector->getDealActivityList($filter, $select, $order);
    }
    public function deleteDealCrmTask(int $taskId): mixed
    {
        return $this->bitrix24ApiConnector->deleteDealCrmTask($taskId);
    }
    public function addDealCrmTask(CrmTask $task): mixed
    {
        return $this->bitrix24ApiConnector->addActivity($task);
    }
    public function deleteSmartProcess(string $typeHexId, int $planId): void
    {
        $this->bitrix24ApiConnector->deleteSmartProcess($typeHexId, $planId);
    }

    public function getPipelines(): array
    {
        return $this->bitrix24ApiConnector->getPipelines();
    }

    public function dealAddNewComment(int $dealId, string $txt): void
    {
        $this->bitrix24ApiConnector->dealAddNewComment($dealId, $txt);
    }

    public function moveDealToStage(int $dealId, string $stageId): mixed
    {
        return $this->bitrix24ApiConnector->moveDealToStage($dealId, $stageId);
    }

    public function notifyUser(int $userId, string $txt): void
    {
        $this->bitrix24ApiConnector->notifyUser($userId, $txt);
    }

    public function getDepartmentUsers(int $departmentId): array
    {
        return $this->bitrix24ApiConnector->getDepartmentUsers($departmentId);
    }

}
