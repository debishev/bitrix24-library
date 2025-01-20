<?php

namespace Debishev\Bitrix24Library\Enums\MobileApp;

enum Bitrix24LibraryMobileAppCommandTypeEnum: string
{
    case LOAD_MY_SELECT_ITEMS = 'loadMySelectItems';
    case SCANQR_CODE = 'scanqrcode';
    case ATTACH_SELECTED_ITEMS = 'attachSelectedItems';
    case LOAD_MY_TASKS = 'loadMyTasks';
    case ADD_MY_TASK_ISSUE = 'addMyTaskIssue';
    case START_MY_TASK = 'startMyTask';
    case FINISH_MY_TASK = 'finishMyTask';
}