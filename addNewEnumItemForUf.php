<?php 


class addNewEnumItem extends AbstractMigration
{
    private $userFieldXmlId = 'UF_LIST_DEAL';

    private function getFieldId()
    {
        $arFields = $GLOBALS['USER_FIELD_MANAGER']->GetUserFields("CRM_DEAL");
        if(array_key_exists( $this->userFieldXmlId, $arFields))
        {
            $fieldId = $arFields[$this->userFieldXmlId]["ID"];
        }

        return $fieldId;
    }

    private function getAddEnum()
    {
        $i = 4;
        $arAddEnum['n'.$i] = array(
            'XML_ID' => "NEW_ITEM_VALUE_XML_ID",//xml_id
            'VALUE' => "Новое значения в списке",//значение
            'DEF' => 'N',//по умолчанию
            'SORT' => 500//сортировка
        );

        return $arAddEnum;
    }

    public function commit()
    {
        $obEnum = new \CUserFieldEnum();
        $obEnum->SetEnumValues(
            $this->getFieldId(),
            $this->getAddEnum()
        );
    }

    public function rollback()
    {
        // удалим значение из списка
        $rsEnum = \CUserFieldEnum::GetList(array(), array(
            "USER_FIELD_ID"=>$this->getFieldId(),
            'XML_ID' => "NEW_ITEM_VALUE_XML_ID",
        ));
        if($arEnum = $rsEnum->Fetch())
        {
            $obEnum = new \CUserFieldEnum;
            $obEnum->SetEnumValues(
                $this->getFieldId(),
                array(
                    $arEnum["ID"] => array(
                        "DEL" => "Y",
                    ),
                )
            );
        }
    }

}


