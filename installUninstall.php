<?php
class Module extends AbstractMigration
{
    public function up()
    {
        \Bitrix\Main\Loader::includeModule('main');
        $id = "test.test";
        $Module = \CModule::CreateModuleObject($id);
        if($Module)
        {
            if(\COption::GetOptionString("main", "event_log_marketplace", "Y") === "Y")
            {
                \CEventLog::Log("INFO", "MP_MODULE_INSTALLED", "main", $id);
            }
            $Module->DoInstall();
        }
    }
    
    public function down()
    {
        \Bitrix\Main\Loader::includeModule('main');
        $id = "test.test";
        $Module = \CModule::CreateModuleObject($id);
        if($Module)
        {
            if(\COption::GetOptionString("main", "event_log_marketplace", "Y") === "Y")
            {
                \CEventLog::Log("INFO", "MP_MODULE_UNINSTALLED", "main", $id);
            }
            $Module->DoUninstall();
        }
    }
    
}
