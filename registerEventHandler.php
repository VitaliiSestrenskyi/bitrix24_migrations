<?php
class RegisterEventHandler extends AbstractMigration
{
    
    public function up()
    {
        $MODULE_ID = 'xxxx.xxx';
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler(
            'main',
            'OnEpilog',
            $MODULE_ID,
            '\Xxx\OnEpilogListener',
            'OnEpilogListenerHandler'
        );
        CopyDirFiles(Application::getInstance()->getDocumentRoot().'/local/modules/'.self::MODULE_ID.'/install/css',
            Application::getInstance()->getDocumentRoot().BX_ROOT."/css",
            true,
            true
        );
        self::cleanAllCache();
    }
    public function down()
    {
        $MODULE_ID = 'xxxx.xxx';
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler(
            'main',
            'OnEpilog',
            $MODULE_ID,
            '\Xxx\OnEpilogListener',
            'OnEpilogListenerHandler'
        );
        DeleteDirFilesEx( BX_ROOT."/css/".self::MODULE_ID.'/crm_deal_details.css' );
        self::cleanAllCache();
    }
    
    public static function cleanAllCache(){
        BXClearCache(true);
        $GLOBALS["CACHE_MANAGER"]->CleanAll();
        $GLOBALS["stackCacheManager"]->CleanAll();
        $staticHtmlCache = \Bitrix\Main\Data\StaticHtmlCache::getInstance();
        $staticHtmlCache->deleteAll();
    }
}
