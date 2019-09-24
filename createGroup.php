<?php 
class Migration
{    
    public function commit()
    {
      self::createGroup();
    }
    
    public function rollback()
    {
       self::deleteGroup();
    }
    
        /**
     * @throws \Bitrix\Main\LoaderException
     */
    protected function createGroup(){
        if(\Bitrix\Main\Loader::includeModule('main')){
            $group = new \CGroup;
            $arFields = [
                "ACTIVE"       => "Y",
                "C_SORT"       => 100,
                "NAME"         => "TEST",
                "DESCRIPTION"  => "TEST",
                "USER_ID"      => [],
                "STRING_ID"    => "TEST"
            ];
            $groupId = $group->Add($arFields);
            if(strlen($group->LAST_ERROR)>0){
                ShowError($group->LAST_ERROR);
            }
        }
    }

    /**
     * @throws \Bitrix\Main\LoaderException
     */
    protected function deleteGroup(){
        if(\Bitrix\Main\Loader::includeModule('main')){
            $by="c_sort";
            $order="desc";
            $rsGroups = \CGroup::GetList($by, $order, ["STRING_ID"=>"TEST"]);
            if($resGroup = $rsGroups->Fetch()){
                global $DB;
                $delId = IntVal($resGroup['ID']);
                $group = new \CGroup;
                $DB->StartTransaction();
                if(!$group->Delete($delId))
                {
                    $DB->Rollback();
                }
                $DB->Commit();
            }
        }
    }
    
    
}
