<?php

class ExistingDeal extends AbstractMigration
{
    private $arFields = [
        'ENTITY_ID' => 'CRM_DEAL',
        'FIELD_NAME' => 'UF_BOOLEAN_DEAL',
        'USER_TYPE_ID' => 'boolean',
        'XML_ID' => 'UF_BOOLEAN_DEAL',
        'SORT' => '100',
        'MULTIPLE' => null,
        'MANDATORY' => null,
        'SHOW_FILTER' => 'N',
        'SHOW_IN_LIST' => null,
        'EDIT_IN_LIST' => null,
        'IS_SEARCHABLE' => null,
        'SETTINGS' => array(
            'DEFAULT_VALUE' => 0,
            'DISPLAY' => 'CHECKBOX',
        ),
        'EDIT_FORM_LABEL' => array(
            'ru' => 'Test',
            'en' => 'UF_BOOLEAN_DEAL',
        ),
        'LIST_COLUMN_LABEL' => array(
            'ru' => 'Test',
            'en' => 'UF_BOOLEAN_DEAL',
        ),
        'LIST_FILTER_LABEL' => array(
            'ru' => 'Test',
            'en' => 'UF_BOOLEAN_DEAL',
        ),
        'ERROR_MESSAGE' => array(
            'ru' => '',
            'en' => '',
        ),
        'HELP_MESSAGE' => array(
            'ru' => 'Test',
            'en' => 'UF_BOOLEAN_DEAL',
        ),
    ];

    public function up()
    {
        $obUserField = new CUserTypeEntity;
        $obUserField->Add($this->arFields);
    }

    public function down()
    {
        $rsData = CUserTypeEntity::GetList(
            array($by => $order),
            array('FIELD_NAME' => $this->arFields['FIELD_NAME'])
        );
        if ($arRes = $rsData->Fetch())
        {
            $obCUserTypeEntity = new CUserTypeEntity;
            $obCUserTypeEntity->Delete($arRes['ID']);
        }
    }
}



