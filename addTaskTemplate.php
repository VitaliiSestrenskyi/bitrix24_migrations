<?php


class ttes extends \WS\ReduceMigrations\Scenario\ScriptScenario {

    /**
     * Name of scenario
     **/
    static public function name() {
        return "Add task template";
    }

    /**
     * Priority of scenario
     **/
    static public function priority() {
        return self::PRIORITY_HIGH;
    }

    /**
     * @return string hash
     */
    static public function hash() {
        return "589b0afdda05945357db34d321b182e7d316e591";
    }

    /**
     * @return int approximately time in seconds
     */
    static public function approximatelyTime() {
        return 90;
    }

    public function commit() {
        self::createTemplate();
    }

    public function rollback() {
        self::deleteTemplate();
    }

    #####################################################################################

    static function getAdminUsersForTask():array {
        $responsibleId = 1;
        $arBpUsersGroup = [1, 2, 3];
        return [
            'RESPONSIBLES'=>serialize([$responsibleId]),
            'RESPONSIBLE_ID'=>serialize([$responsibleId]),
            'ACCOMPLICES'=>serialize($arBpUsersGroup),
            'AUDITORS'=>serialize([]),
        ];
    }

    static function getTaskFieldsAdd(){
        if( \Bitrix\Main\Loader::includeModule("tasks") &&
            \Bitrix\Main\Loader::includeModule("main") &&
            \Bitrix\Main\Loader::includeModule('socialnetwork'))
        {
            $arTaskUsers = self::getAdminUsersForTask();

            $by = 'ID';
            $order = 'ASC';
            $arSite = \CSite::GetList(
                $by,
                $order,
                [
                    'ACTIVE'=>'Y',
                    'DEF'=>'Y',
                ]
            )->fetch();
            $resAdminTaskGroup = \CSocNetGroup::GetList(
                [],
                [
                    'SITE_ID'=>$arSite['LID'],
                    'ACTIVE'=>'Y',
                    'NAME'=>'project TEST',
                ]
            )->fetch();

            $arFields = array (
                'TITLE' => 'CRM: Task TEST',
                'DESCRIPTION' => '
    [B]Task description[/B]




    [B]Expected task result[/B]


    ',
                'DESCRIPTION_IN_BBCODE' => 'Y',
                'PRIORITY' => '1',
                'TIME_ESTIMATE' => '1',
                'REPLICATE' => 'N',
                'CREATED_BY' => '1',
                'ALLOW_CHANGE_DEADLINE' => 'Y',
                'ALLOW_TIME_TRACKING' => 'Y',
                'TASK_CONTROL' => 'N',
                'ADD_IN_REPORT' => 'N',
                'MATCH_WORK_TIME' => 'N',
                'GROUP_ID' => $resAdminTaskGroup['ID'],
                'PARENT_ID' => null,
                'MULTITASK' => 'N',
                'SITE_ID' => $arSite['LID'],
                'DEADLINE_AFTER' => '1200',
                'START_DATE_PLAN_AFTER' => '0',
                'END_DATE_PLAN_AFTER' => '0',
                'TPARAM_REPLICATION_COUNT' => 0,
                'ZOMBIE' => 'N',
                'UF_TASK_WEBDAV_FILES' => [],
                'RESPONSIBLE_ID' => $arTaskUsers['RESPONSIBLE_ID'],
                'ACCOMPLICES' => $arTaskUsers['ACCOMPLICES'],
                'AUDITORS' => $arTaskUsers['AUDITORS'],
                'RESPONSIBLES' => $arTaskUsers['RESPONSIBLES'],
                'DEPENDS_ON' => serialize([]),
                'REPLICATE_PARAMS' => serialize(array(
                    'EVERY_DAY' => 1,
                    'EVERY_WEEK' => 1,
                    'MONTHLY_TYPE' => '1',
                    'MONTHLY_DAY_NUM' => 1,
                    'MONTHLY_MONTH_NUM_1' => 1,
                    'MONTHLY_WEEK_DAY_NUM' => '0',
                    'MONTHLY_WEEK_DAY' => '0',
                    'MONTHLY_MONTH_NUM_2' => 1,
                    'YEARLY_TYPE' => '1',
                    'YEARLY_DAY_NUM' => 1,
                    'YEARLY_MONTH_1' => '0',
                    'YEARLY_WEEK_DAY_NUM' => '0',
                    'YEARLY_WEEK_DAY' => '0',
                    'YEARLY_MONTH_2' => '0',
                    'TIME' => '05:00',
                    'TIMEZONE_OFFSET' => 0,
                    'START_DATE' => '',
                    'REPEAT_TILL' => 'endless',
                    'END_DATE' => '',
                    'TIMES' => 0,
                    'WEEK_DAYS' =>
                        array (
                        ),
                    'NEXT_EXECUTION_TIME' => '',
                    'PERIOD' => 'daily',
                    'WORKDAY_ONLY' => 'N',
                )),
                'TAGS' => serialize([]),
            );

            return $arFields;
        }
    }

    static function createTemplate(){
        $arFields = self::getTaskFieldsAdd();
        $resCheckTemplateExist = \Bitrix\Tasks\Internals\Task\TemplateTable::getList([
            'filter'=>[
                '=TITLE'=>$arFields['TITLE'],
                '=ZOMBIE'=>$arFields['ZOMBIE'],
                '=GROUP_ID'=>$arFields['GROUP_ID'],
            ],
            'select'=>['ID'],
        ])->fetch();
        if(!$resCheckTemplateExist){
            $resultTemplate = \Bitrix\Tasks\Internals\Task\TemplateTable::add($arFields);
            if($resultTemplate->isSuccess()){
                $resIblock = \Bitrix\Iblock\IblockTable::getList([
                    'filter'=>[
                        '=XML_ID'=>'departments',
                    ],
                    'select'=>[
                        'ID'
                    ],
                ])->fetch();
                if($resIblock){
                    $resDepartment = \Bitrix\Iblock\SectionTable::getList([
                        'filter'=>[
                            '=IBLOCK_ID'=>$resIblock['ID'],
                            '=IBLOCK_SECTION_ID'=>null,
                            '=XML_ID'=>[
                                'TEST',
                            ],
                        ],
                        'select'=>[
                            'ID',
                        ],
                    ])->fetch();
                    $resultAccessLevel = \Bitrix\Main\TaskTable::getList([
                        'filter'=>[
                            '=NAME'=>'tasks_task_template_full',
                            '=MODULE_ID'=>'tasks',
                            '=SYS'=>'Y',
                            '=BINDING'=>'task_template',
                        ],
                        'select'=>['ID'],
                    ])->fetch();
                    if (is_array($resDepartment) && is_array($resultAccessLevel) ){
                        $arAccessFields = [
                            'GROUP_CODE'=>'DR'.$resDepartment['ID'], //ID department
                            'ENTITY_ID'=>$resultTemplate->getId(), //ID template
                            'TASK_ID'=>$resultAccessLevel['ID'], //ID from Access Level - b_task
                        ];
                        $resultAccessTemplate = \Bitrix\Tasks\Internals\Task\Template\AccessTable::add($arAccessFields);
                    }
                }
            }
        }
    }


    static function deleteTemplate(){
        $arFields = self::getTaskFieldsAdd();
        $resCheckTemplateExist = \Bitrix\Tasks\Internals\Task\TemplateTable::getList([
            'filter'=>[
                '=TITLE'=>$arFields['TITLE'],
                '=ZOMBIE'=>$arFields['ZOMBIE'],
                '=GROUP_ID'=>$arFields['GROUP_ID'],
            ],
            'select'=>['ID'],
        ])->fetch();
        if($resCheckTemplateExist){
            $templateId = $resCheckTemplateExist['ID'];
            $resultDelete = \Bitrix\Tasks\Internals\Task\TemplateTable::delete($templateId);
            $resAccess = \Bitrix\Tasks\Internals\Task\Template\AccessTable::getList([
                'filter'=>[
                    '=ENTITY_ID'=>$templateId,
                ],
                'select'=>['ID'],
            ])->fetch();
            if($resAccess){
                $resultDeleteAccess = \Bitrix\Tasks\Internals\Task\Template\AccessTable::delete($resAccess['ID']);
            }
        }
    }



}
