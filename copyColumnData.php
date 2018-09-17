<?php 

class copyColumnDataTable extends AbstractMigration
{
    public function up()
    {
        $connection = \Bitrix\Main\Application::getInstance()->getConnection();

        $sql = "
        UPDATE deal 
        SET PRICE = OLD_PRICE
        WHERE UF_PARENT_PRICE > 0;
        ";
        $connection->queryExecute($sql);
        unset($sql);      
    }
    public function down()
    {
        $connection =  \Bitrix\Main\Application::getInstance()->getConnection();
        $sql = "
        UPDATE deal 
        SET PRICE = null;
        ";
        $connection->queryExecute($sql);
    }
}



