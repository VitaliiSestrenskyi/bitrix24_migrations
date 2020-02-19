<?php


class crm_relations extends \WS\ReduceMigrations\Scenario\ScriptScenario {

    static public function name() {
        return "Crm relations";
    }

    static public function priority() {
        return self::PRIORITY_HIGH;
    }

    static public function hash() {
        return "2de829a0b13ec71e37c6ea0f4cf7c53df608c292";
    }

    static public function approximatelyTime() {
        return 90;
    }



    public function commit() {
        self::setRelations();
    }

    public function rollback() {
        // my code
    }

    static function setRelations(){

        if(\Bitrix\Main\Loader::includeModule('crm') && \Bitrix\Main\Loader::includeModule('main')){
            $dbCCrmRole = \CCrmRole::GetList(
                [],
                []
            );
            $arAllRoles = [];
            while($res = $dbCCrmRole->Fetch()){
                $code = str_replace(" ", "_", $res['NAME']);
                $arAllRoles[$code] = $res['ID'];
            }
            if(count($arAllRoles) > 0){
                $dbGroupTable = \Bitrix\Main\GroupTable::getList([
                    'filter'=>[
                        'STRING_ID'=>[
                            'ADMINISTRATORS',
                        ]
                    ],
                    'select'=>[
                        'ID',
                        'NAME',
                        'STRING_ID'
                    ],
                ]);
                $arPerms = [];
                while($resGroup = $dbGroupTable->fetch()){
                    if($resGroup['NAME'] == 'Administrators'){
                        $arPerms['G'.$resGroup['ID']] = [
                            $arAllRoles['Full_access']
                        ];
                    }
                    if($resGroup['NAME'] == 'AdministratorsCS'){
                        $arPerms['G'.$resGroup['ID']] = [
                            $arAllRoles['Subdepartments']
                        ];
                    }
                }
                $CCrmRole = new \CcrmRole();
                $CCrmRole->SetRelation($arPerms);
                if (IsModuleInstalled("bitrix24")){
                    \CCrmSaleHelper::deleteAllUserFromShopGroup();
                    $cache = new \CPHPCache;
                    $cache->CleanDir("/crm/list_crm_roles/");
                }
            }
        }
    }


}
