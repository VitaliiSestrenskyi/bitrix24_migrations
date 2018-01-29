<?php
use Bitrix\Main\Application;

class changeColumnTable extends AbstractMigration
{
    public function commit()
    {
        $connection = Application::getInstance()->getConnection();

        $sql = [];
        $sql[] = "ALTER TABLE `repayments` DROP `COLUMN_NAME_TEST`;";
        $sql[] = "ALTER TABLE `repayments` ADD `COLUMN_NAME_TEST` varchar(255) AFTER `COLUMN_NAME_TEST_2`;";
        
        foreach ($sql as $item)
        {
            $connection->queryExecute($item);
        }
    }

    public function rollback()
    {
        $connection = Application::getInstance()->getConnection();

        $sql = [];
        $sql[] = "ALTER TABLE `repayments` DROP `COLUMN_NAME_TEST`;";
        $sql[] = "ALTER TABLE `repayments` ADD `COLUMN_NAME_TEST` varchar(255) NOT NULL AFTER `COLUMN_NAME_TEST_2`;";
        
        foreach ($sql as $item)
        {
            $connection->queryExecute($item);
        }
    }
    
}
