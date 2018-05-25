<?php

class migration 
{
    private $arFields = [
        'ENTITY_ID' => 'CRM_DEAL',
        'FIELD_NAME' => 'UF_COLLETERAL_TYPE_N',
        'USER_TYPE_ID' => 'enumeration',
        'XML_ID' => 'UF_COLLETERAL_TYPE_N',
        'SORT' => '100',
        'MULTIPLE' => null,
        'MANDATORY' => null,
        'SHOW_FILTER' => 'N',
        'SHOW_IN_LIST' => null,
        'EDIT_IN_LIST' => null,
        'IS_SEARCHABLE' => null,
        'SETTINGS' => array(
            'DISPLAY'=>'UI',
            'LIST_HEIGHT'=>5,
            'CAPTION_NO_VALUE'=>'Значения не найдено',
            'SHOW_NO_VALUE'=>'Y'
        ),
        'EDIT_FORM_LABEL' => array(
            'ru' => 'Тип залога',
        ),
        'LIST_COLUMN_LABEL' => array(
            'ru' => 'Тип залога',
        ),
        'LIST_FILTER_LABEL' => array(
            'ru' => 'Тип залога',
        ),
        'ERROR_MESSAGE' => array(
            'ru' => 'Тип залога',
        ),
        'HELP_MESSAGE' => array(
            'ru' => 'Тип залога',
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


