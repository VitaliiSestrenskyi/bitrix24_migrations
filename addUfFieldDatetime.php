<?php

class CreateUfTestDealField extends AbstractMigration
{
    private $arFields = [
        'ENTITY_ID' => 'CRM_DEAL',
        'FIELD_NAME' => 'UF_TEST_DEAL',
        'USER_TYPE_ID' => 'datetime',
        'XML_ID' => 'UF_TEST_DEAL',
        'SORT' => '100',
        'MULTIPLE' => null,
        'MANDATORY' => null,
        'SHOW_FILTER' => 'N',
        'SHOW_IN_LIST' => null,
        'EDIT_IN_LIST' => null,
        'IS_SEARCHABLE' => null,
        'SETTINGS' => array(
            'DEFAULT_VALUE' => '',
            'USE_SECOND' => 'N',
        ),
        'EDIT_FORM_LABEL' => array(
            'ru' => 'Тест',
            'en' => 'UF_TEST_DEAL',
        ),
        'LIST_COLUMN_LABEL' => array(
            'ru' => 'Тест',
            'en' => 'UF_TEST_DEAL',
        ),
        'LIST_FILTER_LABEL' => array(
            'ru' => 'Тест',
            'en' => 'UF_TEST_DEAL',
        ),
        'ERROR_MESSAGE' => array(
            'ru' => 'Тест',
            'en' => '',
        ),
        'HELP_MESSAGE' => array(
            'ru' => 'Тест',
            'en' => 'UF_TEST_DEAL',
        ),
    ];
    public function up()
    {
        $obUserField = new \CUserTypeEntity;
        $obUserField->Add($this->arFields);
    }
    public function down()
    {
        $rsData = \CUserTypeEntity::GetList(
            array($by => $order),
            array('FIELD_NAME' => $this->arFields['FIELD_NAME'], 'ENTITY_ID'=>$this->arFields['ENTITY_ID'] )
        );
        if ($arRes = $rsData->Fetch())
        {
            $obCUserTypeEntity = new \CUserTypeEntity;
            $obCUserTypeEntity->Delete($arRes['ID']);
        }
    }
}
