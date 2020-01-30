<?php

class test extends \WS\ReduceMigrations\Scenario\ScriptScenario {

    public static $arFields = [
        'NAME' => 'group',
        'DESCRIPTION' => 'group',
        'VISIBLE' => 'N',
        'OPENED' => 'N',
        'CLOSED' => 'N',
        'SUBJECT_ID' => '2',
        'KEYWORDS' => ',',
        'INITIATE_PERMS' => 'K',
        'SPAM_PERMS' => 'K',
        'PROJECT' => 'N',
        'LANDING' => 'N',
        'IMAGE_ID' => [
            'del' => 'Y',
            'old_file' => null,
        ],
        'SITE_ID' => [ 0 => 's1']
    ];


    public function commit() {

        if( \Bitrix\Main\Loader::includeModule('bizproc') &&
            \Bitrix\Main\Loader::includeModule('socialnetwork') &&
            \Bitrix\Main\Loader::includeModule('main')
        ){
            $dbUser = \Bitrix\Main\UserTable::getList([
                'filter'=>[
                    '=EMAIL'=>'test@test.com'
                ],
                'select'=>['ID']
            ]);
            if($resUser = $dbUser->fetch()){
                $ownerId = $resUser['ID'];
                $arFields = self::$arFields;
                $resGroup = \CSocNetGroup::GetList([], ['NAME'=>$arFields['NAME']])->Fetch();
                if($resGroup === false){
                    \CSocNetGroup::CreateGroup($ownerId, $arFields, false);
                }
            }
        }

    }


    public function rollback() {
        // my code

    }
}
