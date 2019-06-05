<?php 

class AbstractMigration
{
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

    public function up()
    {
        if(!\Bitrix\Main\Loader::includeModule('crm'))
        {
            return;
        }
        foreach (self::getDealCategories() as $arCategory)
        {
            \Bitrix\Crm\Category\Entity\DealCategoryTable::add($arCategory);
        }
    }
    
    public function down()
    {
        if(!\Bitrix\Main\Loader::includeModule('crm'))
        {
            return;
        }
        foreach (self::getDealCategories() as $arCategory)
        {
            $res = \Bitrix\Crm\Category\Entity\DealCategoryTable::getList([
                'filter'=>['NAME'=>$arCategory['NAME']],
                'select'=>['ID'],
            ])->fetch();
            if($res)
            {
                \Bitrix\Crm\Category\Entity\DealCategoryTable::delete($res['ID']);
            }
        }
    }
    
}
