<?php
class CreateUfTestField extends AbstractMigration
{
       private $arFields = [
        'FIELD_NAME' => 'UF_TEST',
        'USER_TYPE_ID' => 'string',
        'XML_ID' => 'UF_TEST',
        'SORT' => '100',
        'MULTIPLE' => null,
        'MANDATORY' => 'Y',
        'SHOW_FILTER' => 'N',
        'SHOW_IN_LIST' => null,
        'EDIT_IN_LIST' => null,
        'IS_SEARCHABLE' => null,
        'SETTINGS' => array(
            'DEFAULT_VALUE' => '',
            'SIZE' => '20',
            'ROWS' => '1',
            'MIN_LENGTH' => '0',
            'MAX_LENGTH' => '0',
            'REGEXP' => '',
        ),
        'EDIT_FORM_LABEL' => array(
            'ru' => 'UF_TEST',
        ),
        'LIST_COLUMN_LABEL' => array(
            'ru' => 'UF_TEST',
        ),
        'LIST_FILTER_LABEL' => array(
            'ru' => 'UF_TEST',
        ),
        'ERROR_MESSAGE' => array(
            'ru' => 'UF_TEST',
        ),
        'HELP_MESSAGE' => array(
            'ru' => 'UF_TEST',
        ),
    ];

    public function up()
    {
        \Bitrix\Main\Loader::includeModule('highloadblock');
        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList([
            'filter'=>['NAME'=>'WebStatuses'],//code of hl table
            'select'=>['*'],
        ])->fetch();
        if($hlblock)
        {
            $this->arFields['ENTITY_ID'] = 'HLBLOCK_'.$hlblock['ID'];
            $obUserField = new \CUserTypeEntity;
            $obUserField->Add($this->arFields);
        }
    }
    public function down()
    {
        \Bitrix\Main\Loader::includeModule('highloadblock');
        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList([
            'filter'=>['NAME'=>'WebStatuses'], //code of hl table
            'select'=>['*'],
        ])->fetch();
        if($hlblock)
        {
            $this->arFields['ENTITY_ID'] = 'HLBLOCK_'.$hlblock['ID'];
            $rsData = \CUserTypeEntity::GetList(
                array($by => $order),
                array('FIELD_NAME' => $this->arFields['FIELD_NAME'], 'ENTITY_ID' => $this->arFields['ENTITY_ID'])
            );
            if ($arRes = $rsData->Fetch())
            {
                $obCUserTypeEntity = new \CUserTypeEntity;
                $obCUserTypeEntity->Delete($arRes['ID']);
            }
        }
    }
}
