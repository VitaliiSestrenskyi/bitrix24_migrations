<?php 
class Migration
{    

    public function commit(){
        if(\Bitrix\Main\Loader::includeModule('main')){
            $arGroupAdm = \Bitrix\Main\GroupTable::query()
                ->setFilter(['STRING_ID'=>'test'])
                ->setSelect(['ID'])
                ->exec()
                ->fetch();
            if($arGroupAdm){
                $db = \Bitrix\Main\UserTable::query()
                    ->setFilter([
                        'EMAIL'=>[
                            'test@test.ru',
                        ],
                    ])
                    ->setSelect(['ID'])
                    ->exec();
                while ($resUser = $db->fetch()){
                    $arGroupsDb = \CUser::GetUserGroupList( $resUser['ID'] );
                    while ($arGroup = $arGroupsDb->Fetch()){
                        $arGroups[] = $arGroup;
                    }
                    $arGroups[] = [
                        'GROUP_ID' => $arGroupAdm['ID'],
                        'DATE_ACTIVE_FROM'=>'',
                        'DATE_ACTIVE_TO'=>''
                    ];
                    \CUser::SetUserGroup($resUser['ID'], $arGroups);
                }
            }
        }
    }

    public function rollback(){
        if(\Bitrix\Main\Loader::includeModule('main')){
                $arGroupAdm = \Bitrix\Main\GroupTable::query()
                    ->setFilter(['STRING_ID'=>'test'])
                    ->setSelect(['ID'])
                    ->exec()
                    ->fetch();
                if($arGroupAdm){
                    $db = \Bitrix\Main\UserTable::query()
                        ->setFilter([
                            'EMAIL'=>[
                                'test@test.ru',
                            ],
                        ])
                        ->setSelect(['*'])
                        ->exec();
                    while ($resUser = $db->fetch()){
                        $arGroupsDb = \CUser::GetUserGroupList( $resUser['ID'] );
                        while ($arGroup = $arGroupsDb->Fetch()){
                            if($arGroup['GROUP_ID'] !== $arGroupAdm['ID']){
                                $arGroups[] = $arGroup;
                            }
                        }
                        \CUser::SetUserGroup($resUser['ID'], $arGroups);
                    }
        }
        }
    }
    
    
}
