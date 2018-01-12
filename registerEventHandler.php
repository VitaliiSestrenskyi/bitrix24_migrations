<?php
class RegisterEventHandler extends AbstractMigration
{
    const MODULE_ID = 'xxxx.xxx';
    
    public function up()
    {
        EventManager::getInstance()->registerEventHandler(
            'main',
            'OnEpilog',
            self::MODULE_ID,
            '\Xxx\OnEpilogListener',
            'OnEpilogListenerHandler'
        );
        CopyDirFiles(Application::getInstance()->getDocumentRoot().'/local/modules/'.self::MODULE_ID.'/install/css',
            Application::getInstance()->getDocumentRoot().BX_ROOT."/css",
            true,
            true
        );
    }
    public function down()
    {
        EventManager::getInstance()->unRegisterEventHandler(
            'main',
            'OnEpilog',
            self::MODULE_ID,
            '\Xxx\OnEpilogListener',
            'OnEpilogListenerHandler'
        );
        DeleteDirFilesEx( BX_ROOT."/css/".self::MODULE_ID.'/crm_deal_details.css' );
    }
}
