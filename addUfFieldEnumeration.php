<?php

class migration 
{
   private function getAddEnum()
    {
        $arAddEnum['n0'] = array(
            'XML_ID' => "BBBB",
            'VALUE' => "BBBB",
            'DEF' => 'N',
            'SORT' => 100
        );
        $arAddEnum['n1'] = array(
            'XML_ID' => "VVVV",
            'VALUE' => "VVVV",
            'DEF' => 'N',
            'SORT' => 200
        );
        return $arAddEnum;
    }

    private $arFields =
        [
            'ENTITY_ID' => 'CRM_CONTACT',
            'FIELD_NAME' => 'UF_TYPE_PAT',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_TYPE_PAT',
            'SORT' => '100',
            'MULTIPLE' => null,
            'MANDATORY' => null,
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => null,
            'EDIT_IN_LIST' => null,
            'IS_SEARCHABLE' => null,
            'SETTINGS' => array(
                'DEFAULT_VALUE' => ''
            ),
            'EDIT_FORM_LABEL' => array(
                'ru' => 'Тип',
            ),
            'LIST_COLUMN_LABEL' => array(
                'ru' => 'Тип',
            ),
            'LIST_FILTER_LABEL' => array(
                'ru' => 'Тип',
            ),
            'ERROR_MESSAGE' => array(
                'ru' => 'Тип',
            ),
            'HELP_MESSAGE' => array(
                'ru' => 'Тип',
            ),
        ];

    private function getFieldId()
    {
        $arFields = $GLOBALS['USER_FIELD_MANAGER']->GetUserFields("CRM_CONTACT");
        if(array_key_exists( 'UF_TYPE_PAT', $arFields))
        {
            $fieldId = $arFields['UF_TYPE_PAT']["ID"];
        }
        return $fieldId;
    }

    /**
     * Write action by apply scenario. Use method `setData` for save need rollback data
     **/
    public function commit()
    {
        $obEnum = new \CUserFieldEnum();
        $obUserField = new \CUserTypeEntity;
        $obUserField->Add($this->arFields);
        $obEnum->SetEnumValues(
            $this->getFieldId(),
            $this->getAddEnum()
        );
    }

    /**
     * Write action by rollback scenario. Use method `getData` for getting commit saved data
     **/
    public function rollback()
    {
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


