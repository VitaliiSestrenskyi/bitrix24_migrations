<?php
class CreateUfTestDealField extends AbstractMigration
{
    private $arFields = [
        'ENTITY_ID' => 'CRM_DEAL',
        'FIELD_NAME' => 'UF_TEST',
        'USER_TYPE_ID' => 'iblock_element',
        'XML_ID' => 'UF_TEST',
        'SORT' => '100',
        'MULTIPLE' => null,
        'MANDATORY' => null,
        'SHOW_FILTER' => 'N',
        'SHOW_IN_LIST' => null,
        'EDIT_IN_LIST' => null,
        'IS_SEARCHABLE' => null,
        'SETTINGS' => array (
            'DISPLAY' => 'LIST',
            'LIST_HEIGHT' => 20,
            'IBLOCK_ID' => 81,
            'DEFAULT_VALUE' => '',
            'ACTIVE_FILTER' => 'N',
        ),
        'EDIT_FORM_LABEL' => array(
            'ru' => 'test',
        ),
        'LIST_COLUMN_LABEL' => array(
            'ru' => 'test',
        ),
        'LIST_FILTER_LABEL' => array(
            'ru' => 'test',
        ),
        'ERROR_MESSAGE' => array(
            'ru' => '',
        ),
        'HELP_MESSAGE' => array(
            'ru' => 'test',
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
            array('FIELD_NAME' => $this->arFields['FIELD_NAME'], 'ENTITY_ID' => $this->arFields['ENTITY_ID'])
        );
        if ($arRes = $rsData->Fetch())
        {
            $obCUserTypeEntity = new CUserTypeEntity;
            $obCUserTypeEntity->Delete($arRes['ID']);
        }
    }
}
