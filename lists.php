<?php

/**
 * Class definition update migrations scenario actions
 **/
class ws_m_1550063367_dobavleniya_infobloka_personal extends \WS\ReduceMigrations\Scenario\ScriptScenario
{

    /**
     * Name of scenario
     **/
    static public function name()
    {
        return "Добавления инфоблока - TEST";
    }

    /**
     * Priority of scenario
     **/
    static public function priority()
    {
        return self::PRIORITY_HIGH;
    }

    /**
     * @return string hash
     */
    static public function hash()
    {
        return "b9aaf1ae154df97fa5e3049af2307dcfef575d7d";
    }

    /**
     * @return int approximately time in seconds
     */
    static public function approximatelyTime()
    {
        return 20;
    }

    /**
     * Write action by apply scenario. Use method `setData` for save need rollback data
     **/
    public function commit()
    {
        $this->createIblock();
        $this->createProps();
    }

    /**
     * Write action by rollback scenario. Use method `getData` for getting commit saved data
     **/
    public function rollback()
    {
        $this->deleteIblock();
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///

    public function createIblock()
    {
        \Bitrix\Main\Loader::includeModule('main');
        \Bitrix\Main\Loader::includeModule('iblock');

        $site  = \CSite::GetList($by, $order, ['DEFAULT'=>'Y'])->fetch();
        $ib = new \CIBlock;
        $arFields = Array(
            "ACTIVE" => "Y",
            'NAME' => 'TEST',
            "CODE" => 'TEST',
            "XML_ID" => 'TEST',
            "LIST_PAGE_URL" => "",
            "DETAIL_PAGE_URL" => "",
            "IBLOCK_TYPE_ID" => "lists",
            "SITE_ID" => [$site['LID']],
            "GROUP_ID"=>["2" => "R"],
            "SORT" => 100,
            "PICTURE" => "",
            "DESCRIPTION" => "",
            "DESCRIPTION_TYPE" => "",
            'BIZPROC'=>'Y',
            'WORKFLOW'=>'N',
            'INDEX_ELEMENT'=>'Y',
            "ELEMENT_NAME" => 'TEST',
            "ELEMENTS_NAME" => 'TEST',
            "ELEMENT_ADD" => 'TEST',
            "ELEMENT_EDIT" => 'TEST',
            "ELEMENT_DELETE" => 'TEST',
            "SECTION_NAME" => 'Раздел',
            "SECTIONS_NAME" => 'Разделы',
            "SECTION_ADD" => 'Раздел',
            "SECTION_EDIT" => 'Раздел',
            "SECTION_DELETE" => 'Раздел',
        );
        return $ib->Add($arFields);
    }

    public function createProps()
    {
        \Bitrix\Main\Loader::includeModule('lists');

        $res = \Bitrix\Iblock\IblockTable::getList([
            'filter'=>['CODE'=>"TEST"],
            'select'=>['ID']
        ])->fetch();
        $iblockId = $res['ID'];
        $obList = new \CList( $iblockId );
        $allListsFields = [
            [
                "SORT" => 100,
                "NAME" => 'Название',
                "IS_REQUIRED" => "Y",
                "MULTIPLE" => "N",
                "CODE" => "TEST_NAME",
                "TYPE" => "S",
                "DEFAULT_VALUE" => "",
                "USER_TYPE_SETTINGS" => "",
                "SETTINGS" => [
                    "SHOW_ADD_FORM" => "Y",
                    "SHOW_EDIT_FORM" => "Y",
                    "ADD_READ_ONLY_FIELD" => "N",
                    "EDIT_READ_ONLY_FIELD" => "N",
                    "SHOW_FIELD_PREVIEW" => "N",
                ],
                "LIST" =>[],
            ],
            [
                "SORT" => 200,
                "NAME" => 'Стоимость',
                "IS_REQUIRED" => "Y",
                "MULTIPLE" => "N",
                "CODE" => "TEST_PRICE",
                "TYPE" => "N",
                "DEFAULT_VALUE" => "",
                "USER_TYPE_SETTINGS" => "",
                "SETTINGS" => [
                    "SHOW_ADD_FORM" => "Y",
                    "SHOW_EDIT_FORM" => "Y",
                    "ADD_READ_ONLY_FIELD" => "N",
                    "EDIT_READ_ONLY_FIELD" => "N",
                    "SHOW_FIELD_PREVIEW" => "N",
                ],
                "LIST" =>[],
            ],
        ];
        foreach ($allListsFields as $allListsField)
        {
            $obList->AddField($allListsField);
        }
        $obList->Save();
        global $CACHE_MANAGER;
        $CACHE_MANAGER->ClearByTag("lists_list_".$iblockId);
    }

    public function deleteIblock()
    {
        global $DB;

        \Bitrix\Main\Loader::includeModule('main');
        \Bitrix\Main\Loader::includeModule('iblock');

        $res = \Bitrix\Iblock\IblockTable::getList([
            'filter'=>['CODE'=>"TEST"],
            'select'=>['ID']
        ])->fetch();
        $DB->StartTransaction();
        if(!\CIBlock::Delete($res['ID']))
        {
            echo 'Delete Iblock error!';
            $DB->Rollback();
        }
        else
            $DB->Commit();
    }

}
