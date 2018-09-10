<?php

class CreateOrderProp 
{

    private $arFields = array(
        'PERSON_TYPE_ID' => 1,
        'NAME' => 'Количество доступных бонусов',
        'TYPE' => 'TEXT',
        'REQUIED' => 'N',
        'DEFAULT_VALUE' => '0',
        'SORT' => 100,
        'CODE' => 'AVAILABLE_BONUSES',
        'USER_PROPS' => 'N',
        'IS_LOCATION' => 'N',
        'IS_LOCATION4TAX' => 'N',
        'PROPS_GROUP_ID' => 1,
        'SIZE1' => 0,
        'SIZE2' => 0,
        'DESCRIPTION' => '',
        'IS_EMAIL' => 'N',
        'IS_PROFILE_NAME' => 'N',
        'IS_PAYER' => 'N',
        'UTIL' => 'Y'
    );
        
    public function up()
    {
        \Bitrix\Main\Loader::includeModule('sale');
        CSaleOrderProps::Add($this->arFields);
    }
    
    public function down()
    {
       \Bitrix\Main\Loader::includeModule('sale');
        $dbProps = CSaleOrderProps::GetList(
            array('SORT' => 'ASC'),
            array(
                'CODE' => $this->arFields['CODE']
            ),
            false,
            false,
            array('ID')
        );
        if ($prop = $dbProps->Fetch())
        {
            CSaleOrderProps::Delete($prop['ID']);
        }
    }
    
}


