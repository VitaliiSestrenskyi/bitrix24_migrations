<?php
class Migration
{
    private $arFields = [
        'ENTITY_ID' => 'CRM_COMPANY',
        'FIELD_NAME' => 'UF_TEST',
        'USER_TYPE_ID' => 'crm',
        'XML_ID' => 'UF_TEST',
        'SORT' => '100',
        'MULTIPLE' => null,
        'MANDATORY' => null,
        'SHOW_FILTER' => 'N',
        'SHOW_IN_LIST' => null,
        'EDIT_IN_LIST' => null,
        'IS_SEARCHABLE' => null,
        'SETTINGS' => array(
            //'LEAD'=>'Y',
            'CONTACT'=>'Y',
            //'COMPANY'=>'Y',
            //'DEAL'=>'Y',
        ),
        'EDIT_FORM_LABEL' => array(
            'ru' => 'Тест',
        ),
        'LIST_COLUMN_LABEL' => array(
            'ru' => 'Тест',
        ),
        'LIST_FILTER_LABEL' => array(
            'ru' => 'Тест',
        ),
        'ERROR_MESSAGE' => array(
            'ru' => 'Тест',
        ),
        'HELP_MESSAGE' => array(
            'ru' => 'Тест',
        ),
    ];

    public function commit()
    {
        $obUserField = new CUserTypeEntity;
        $obUserField->Add($this->arFields);
    }

    public function rollback()
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
