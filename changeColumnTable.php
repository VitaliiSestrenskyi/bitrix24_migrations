<?php
class changeColumnTable extends AbstractMigration
{
    public function commit()
    {
        $connection = \Bitrix\Main\Application::getInstance()->getConnection();

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
        $connection = \Bitrix\Main\Application::getInstance()->getConnection();

        $sql = [];
        $sql[] = "ALTER TABLE `repayments` DROP `COLUMN_NAME_TEST`;";
        $sql[] = "ALTER TABLE `repayments` ADD `COLUMN_NAME_TEST` varchar(255) NOT NULL AFTER `COLUMN_NAME_TEST_2`;";
        
        foreach ($sql as $item)
        {
            $connection->queryExecute($item);
        }
    }
    
}
