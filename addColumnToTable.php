<?php
use Bitrix\Main\Application;

class addColumnToTable extends AbstractMigration
{
    public function up()
    {
         $connection = Application::getInstance()->getConnection();

        $sql = "ALTER TABLE `itua_crm_product_row` ADD `AMOUNT_INDIVIDUAL_DISCOUNT` varchar(255) AFTER `AMOUNT_MANUAL_DISCOUNT`;";
        $connection->queryExecute($sql);
    }
    public function down()
    {
        $connection = Application::getInstance()->getConnection();

        $sql = "ALTER TABLE `itua_crm_product_row` DROP `AMOUNT_INDIVIDUAL_DISCOUNT`;";
        $connection->queryExecute($sql);
    }
}



