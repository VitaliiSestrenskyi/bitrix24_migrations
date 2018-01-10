<?php
use Bitrix\Main\Application;

class addColumnToTable extends AbstractMigration
{
    public function up()
    {
         $connection = Application::getInstance()->getConnection();

        $sql = "ALTER TABLE `crm_table_name` ADD `NEW_COLUMN_NAME` varchar(255) AFTER `DISCOUNT`;";
        $connection->queryExecute($sql);
    }
    public function down()
    {
        $connection = Application::getInstance()->getConnection();

        $sql = "ALTER TABLE `crm_table_name` DROP `NEW_COLUMN_NAME`;";
        $connection->queryExecute($sql);
    }
}



