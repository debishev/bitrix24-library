<?php

namespace Debishev\Bitrix24Library\DataMappers;



use DateTimeImmutable;
use Debishev\Bitrix24Library\Entity\CrmCompany;
use Debishev\Bitrix24Library\Entity\CrmDeal;
use Debishev\Bitrix24Library\Entity\CrmDealContact;
use Debishev\Bitrix24Library\Entity\CrmPipeLine;
use Debishev\Bitrix24Library\Entity\CrmPipelineStage;
use Debishev\Bitrix24Library\Entity\CrmProfile;
use Debishev\Bitrix24Library\Entity\CrmSmartProcess;
use Debishev\Bitrix24Library\Entity\CrmTask;
use Debishev\Bitrix24Library\Entity\CrmUser;


class CRMBitrixMapper extends CRMBaseMapper
{

    public function mapOneCrmUser(array $rawData): CrmUser
    {



        $model =  new CrmUser();

        $model->setId($rawData["ID"]);
        $model->setName($rawData["NAME"]);
        $model->setEmail($rawData["EMAIL"]);
        $model->setLastname($rawData["LAST_NAME"] ?? '');
        $model->setSecondName($rawData["SECOND_NAME"] ?? '');
        $model->setDepartments($rawData["UF_DEPARTMENT"]);


        foreach ($rawData as $key => $val) {
            if (str_starts_with($key, 'UF_')) {
                $fields = $model->getCustomFields();
                $fields[$key] = $val;
                $model->setCustomFields($fields);
            }
        }

        return $model;
    }

    public function mapOneCrmProfile(array $rawData): CrmProfile
    {
        $model =  new CrmProfile();
        $model->setAvatar($rawData["PERSONAL_PHOTO"] ?? 'https://api.insite-grozniy.ru/image/no_avatar.png');

        return $model;
    }



    public function mapOneCrmDeal(array $rawData): CrmDeal
    {



        $date = DateTimeImmutable::createFromFormat(DATE_ATOM, $rawData['UF_CRM_1691908403517']);

        if (gettype($date) == "boolean") {
            $date = new DateTimeImmutable();
        }

        $closetAt = DateTimeImmutable::createFromFormat(DATE_ATOM, $rawData['CLOSEDATE']);

        if (!$closetAt) {
            $closetAt = null;
        }

        $isClosed = $rawData['CLOSED'];




        $deal = new CrmDeal();
        $deal->setId($rawData['ID']);
        $deal->setTitle($rawData['TITLE']);
        $deal->setDate($date);
        $deal->setContactId(intval($rawData['CONTACT_ID']));
        $deal->setResponsibleUserId($rawData['ASSIGNED_BY_ID']);
        $deal->setStatus($rawData['STAGE_ID']);
        $deal->setSum(intval($rawData['OPPORTUNITY'])); //intval( str_ireplace('|RUB','',$rawData['UF_CRM_1725885424375']) )
        $deal->setClosedAt($closetAt);
        $deal->setPipelineId($rawData['CATEGORY_ID']);
        $deal->setIsClosed($isClosed == 'Y');
        $deal->setVendor(intval($rawData['UF_CRM_1707157308']) ?? 0);


        foreach ($rawData as $key => $val) {
            if (str_starts_with($key, 'UF_CRM_')) {
                $fields = $deal->getCustomFields();
                $fields[$key] = $val;
                $deal->setCustomFields($fields);
            }
        }

        return $deal;
    }



    public function mapOneCrmSmartProcess(array $rawData): CrmSmartProcess
    {

        $model =  new CrmSmartProcess();
        $model->setId($rawData["id"]);
        $model->setTitle($rawData["title"]);
        $model->setDeal($rawData["parentId2"] ?? 0);
        $model->setCreatedBy($rawData["createdBy"]);
        $model->setSum(intval($rawData["opportunity"]));
        $model->setIsOpen($rawData["opened"] == 'Y');
        $model->setContact($rawData["contactId"] );
        $model->setStageId($rawData["stageId"] ?? '' );


        foreach ($rawData as $key => $val) {
            if (str_starts_with($key, 'ufCrm')) {
                $fields = $model->getCustomFields();
                $fields[$key] = $val;
                $model->setCustomFields($fields);
            }
        }


        return $model;
    }

    public function mapOneToBitrixSmartProcess(CrmSmartProcess $item): array
    {
        $params = [];
        $params['title'] = $item->getTitle();
        $params['parentId2'] = $item->getDeal();
        $params['opportunity'] = $item->getSum();
        $params['contactId'] = $item->getContact();
        $params['stageId'] = $item->getStageId();

        return array_merge($item->getCustomFields(), $params);
    }

    public function mapOneToBitrixDeal(CrmDeal $item): array
    {


        $params = $item->getCustomFields();
        $params['OPPORTUNITY'] = $item->getSum();
        return $params;
    }

    public function mapOneCrmTask(array $rawData): CrmTask
    {


        $deadline = DateTimeImmutable::createFromFormat(DATE_ATOM, $rawData['DEADLINE']);
        $endtime = DateTimeImmutable::createFromFormat(DATE_ATOM, $rawData['END_TIME']);
        if ( gettype($endtime) == 'boolean' ) {
            $endtime = new DateTimeImmutable();
        }

        $task = new CrmTask();
        $task->setId($rawData['ID']);
        $task->setTitle($rawData['SUBJECT']);
        $task->setIsCompleted( $rawData['COMPLETED'] == 'Y' );
        $task->setAssignToUser($rawData['RESPONSIBLE_ID']);
        $task->setAssignToDealId($rawData['OWNER_ID']);
        $task->setDeadline($deadline);
        $task->setProvider($rawData['PROVIDER_ID']);
        $task->setDescription($rawData['DESCRIPTION']);
        $task->setDealId($rawData['OWNER_ID']);
        $task->setEndtime($endtime);


        return  $task;
    }

    public function mapOneToBitrixActivity(CrmTask $task): array
    {
        $result ['TYPE_ID'] = 6;
        $result ['OWNER_TYPE_ID'] = 2;
        $result ['PROVIDER_ID'] = "CRM_TODO";
        $result ['PROVIDER_TYPE_ID'] = "TODO";
        $result ['COMMUNICATIONS'] =  [ ];
        $result ['OWNER_ID'] = $task->getAssignToDealId();
        $result ['SUBJECT'] = $task->getTitle();
        $result ['DESCRIPTION'] = $task->getTitle();
        $result ['START_TIME'] = $task->getSimpleStartDate();
        $result ['END_TIME'] = $task->getSimpleStartDate();
        $result ['DEADLINE'] = $task->getSimpleStartDate();
        $result ['RESPONSIBLE_ID'] = $task->getAssignToUser();
        $result ['PRIORITY'] = "1";
        return $result;
    }


    public function mapOneCrmDealContact(array $rawData): CrmDealContact
    {
        $date = DateTimeImmutable::createFromFormat(DATE_ATOM, $rawData['BIRTHDATE']);
        if (gettype($date) == 'boolean') {
            $date = new DateTimeImmutable();
        }

        $phones = $rawData["PHONE"] ?? [];

        $model = new CrmDealContact();
        $model->setId($rawData["ID"]);
        $model->setName($rawData["NAME"]);
        $model->setLastName($rawData["LAST_NAME"] ?? '');
        $model->setSecondName($rawData["SECOND_NAME"] ?? '');
        $model->setBirthday($date);
        $model->setPhones(array_map(fn($phone) => $phone['VALUE'], $phones));


        return $model;
    }


    public function mapOneCrmPipeline(array $rawData): CrmPipeline
    {
        $model = new CrmPipeLine();
        $model->setId($rawData["id"]);
        $model->setName($rawData["name"]);
        $model->setSort($rawData["sort"]);

        return $model;
    }

    public function mapOneCrmPipelineStage(array $rawData): CrmPipelineStage
    {
        $isClosed = false;
        $isSuccess = false;


        if (str_contains($rawData['STATUS_ID'], ':WON')
            || str_contains($rawData['STATUS_ID'], ':LOSE')
            || str_contains($rawData['STATUS_ID'], ':APOLOGY')
            || str_contains($rawData['STATUS_ID'], 'WON')
            || str_contains($rawData['STATUS_ID'], 'LOSE')
            || str_contains($rawData['STATUS_ID'], 'APOLOGY')
        ) {
            $isClosed = true;
        }

        if (str_contains($rawData['STATUS_ID'], ':WON') || str_contains($rawData['STATUS_ID'], 'WON')) {
            $isSuccess = true;
        }

        $model = new CrmPipelineStage();
        $model->setId($rawData["STATUS_ID"]);
        $model->setName($rawData["NAME"]);
        $model->setSort($rawData["SORT"]);
        $model->setIsClosed($isClosed);
        $model->setIsSuccess($isSuccess);

        return $model;
    }

    public function mapOneCrmCompany(array $rawData): CrmCompany
    {

        $model = new CrmCompany();
        $model->setId($rawData["ID"]);
        $model->setType($rawData["COMPANY_TYPE"]);
        $model->setTitle($rawData["TITLE"]);


        return $model;
    }

}
