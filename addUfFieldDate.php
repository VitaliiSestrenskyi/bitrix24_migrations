<?php
class CreateUfTestDealField extends AbstractMigration
{
    private $arFields = 
    [
            'ENTITY_ID' => 'CRM_DEAL',
            'FIELD_NAME' => 'UF_AGREEMENT_DATE',
            'USER_TYPE_ID' => 'date',
            'XML_ID' => 'UF_AGREEMENT_DATE',
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
                'ru' => 'Дата договора',
            ),
            'LIST_COLUMN_LABEL' => array(
                'ru' => 'Дата договора',
            ),
            'LIST_FILTER_LABEL' => array(
                'ru' => 'Дата договора',
            ),
            'ERROR_MESSAGE' => array(
                'ru' => 'Дата договора',
            ),
            'HELP_MESSAGE' => array(
                'ru' => 'Дата договора',
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
