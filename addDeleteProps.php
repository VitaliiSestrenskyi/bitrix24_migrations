<?php
class ChnageSourceId extends AbstractMigration
{
    public function up()
    {
        $this->createProps();        
    }
    public function down()
    {
        $this->deleteProps();
    }
    
     ///////////////////////////////////////////////////////////////////////////////////////////////////////
    ///
    ///
    ///

    public function createProps()
    {
        if( !\Bitrix\Main\Loader::includeModule('lists') ||            
            !\Bitrix\Main\Loader::includeModule('iblock')
        )
        {
            return;
        }
        $res = \Bitrix\Iblock\IblockTable::getList([
            'filter'=>['CODE'=>"TEST"],
            'select'=>['ID']
        ])->fetch();
        $iblockId = $res['ID'];
        if($iblockId)
        {
            $obList = new \CList( $iblockId );
            $allListsFields = [
                [
                    "SORT" => 150,
                    "NAME" => 'test',
                    "IS_REQUIRED" => "N",
                    "MULTIPLE" => "Y",
                    "CODE" => "TEST",
                    "TYPE" => "S",
                    "DEFAULT_VALUE" => "",
                    "USER_TYPE"=>"bcrmstatusiblockprops",
                    "USER_TYPE_SETTINGS" => [
                        'ENTITY_ID'=>'SOURCE'
                    ],
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
    }

    public function deleteProps()
    {
        if(!\Bitrix\Main\Loader::includeModule('lists') || !\Bitrix\Main\Loader::includeModule('iblock'))
        {
            return;
        }
        $res = \Bitrix\Iblock\IblockTable::getList([
            'filter'=>['CODE'=>"TEST"],
            'select'=>['ID']
        ])->fetch();
        $iblockId = $res['ID'];
        if($iblockId)
        {
            $obList = new \CList( $iblockId );
            $resIblockPropertyTable = \Bitrix\Iblock\PropertyTable::getList([
                'filter'=>[
                    '=IBLOCK_ID'=>$iblockId,
                    '=CODE'=>'TEST',
                ],
                'select'=>['ID']
            ])->fetch();
            if($resIblockPropertyTable)
            {
                $obList->DeleteField("PROPERTY_".$resIblockPropertyTable['ID']);
                $obList->Save();
                global $CACHE_MANAGER;
                $CACHE_MANAGER->ClearByTag("lists_list_".$iblockId);
            }
        }
    }
      
}
