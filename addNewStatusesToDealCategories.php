<?php 

class AbstractMigration
{
    protected static $arStatuses = array(
        'NEW'=>[
            'NAME'=>'Новый заказ',
            'SYSTEM'=>'Y'
        ],
        'RETURNED_WITH_NUANCES'=>[
            'NAME'=>'Должник',
            'SYSTEM'=>'N'
        ],
        'WON'=>[
            'NAME'=>'Успешна',
            'SYSTEM'=>'Y'
        ],
        'LOSE'=>[
            'NAME'=>'Неуспешна',
            'SYSTEM'=>'Y'
        ],
    );
    
    private function getDealCategories():array
    {
        return [
            [
                'CREATED_DATE'=>new \Bitrix\Main\Type\DateTime(),
                'NAME'=>'Test',
                'SORT'=>50,
            ],
            [
                'CREATED_DATE'=>new \Bitrix\Main\Type\DateTime(),
                'NAME'=>'Test2',
                'SORT'=>60,
            ],
        ];
    }
    
    protected function deleteDealStatuses()
    {
        $connection = \Bitrix\Main\Application::getInstance()->getConnection();
        foreach (self::getDealCategories() as $arCategory)
        {
            $res = \Bitrix\Crm\Category\Entity\DealCategoryTable::getList([
                'filter'=>['NAME'=>$arCategory['NAME']],
                'select'=>['ID'],
            ])->fetch();
            if($res)
            {
                $sql = 'DELETE FROM b_crm_status WHERE ENTITY_ID = "' . "DEAL_STAGE_".$res['ID']. '"';
                $connection->queryExecute($sql);
            }
        }
    }

    protected function setDealStatuses()
    {
        $connection = \Bitrix\Main\Application::getInstance()->getConnection();
        $sort = 0;
        foreach (self::getDealCategories() as $arCategory)
        {
            $res = \Bitrix\Crm\Category\Entity\DealCategoryTable::getList([
                'filter'=>['NAME'=>$arCategory['NAME']],
                'select'=>['ID'],
            ])->fetch();
            if($res)
            {
                $categoryId = $res['ID'];
                foreach (self::$arStatuses as $statusId=>$arStatus)
                {
                    $sort += 10;
                    $DEAL_STAGE = "DEAL_STAGE_".$categoryId;
                    $sql = 'INSERT INTO b_crm_status (ENTITY_ID, NAME, STATUS_ID, SORT, SYSTEM)'.
                        ' VALUES ('
                        .'"'.$DEAL_STAGE.'"'.','
                        .'"'.$arStatus["NAME"].'"'.','
                        .'"'.'C'.$categoryId.':'.$statusId.'"'.','
                        .'"'.$sort.'"'.','
                        .'"'.$arStatus["SYSTEM"].'"'.')';

                    $connection->queryExecute($sql);
                }
            }
        }
    }
   
    public function up()
    {
        if(\Bitrix\Main\Loader::includeModule('crm'))
        {
            $this->deleteDealStatuses();
            $this->setDealStatuses();
        }
    }
    
    public function down()
    {
        if(\Bitrix\Main\Loader::includeModule('crm'))
        {
            $this->deleteDealStatuses();
        }
    }
    
}
