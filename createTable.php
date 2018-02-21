<?php
use Bitrix\Main\Application;

class migration 
{
    public function up()
    {
        $connection = Application::getInstance()->getConnection();
        $sql = "CREATE TABLE test 
                (
                  ID int not null auto_increment,
                  ENTITY_ID INT(18) UNSIGNED not null,
                  ENTITY_TYPE varchar(255), 
                  CREATED_AT datetime, 
                  CREATED_BY varchar(255), 
                  FILE_ID INT(18),
                
                  PRIMARY KEY (ID),
                  INDEX IX_TEST(ENTITY_ID, CREATED_BY, FILE_ID, ID),
                
                  CONSTRAINT `FK_ENTITY_ID` FOREIGN KEY (`ENTITY_ID`) REFERENCES `b_crm_deal` (`ID`) ON UPDATE NO ACTION ON DELETE CASCADE,
                  CONSTRAINT `FK_FILE_ID` FOREIGN KEY (`FILE_ID`) REFERENCES `b_file` (`ID`) ON UPDATE NO ACTION ON DELETE CASCADE
                );
                ";
        $connection->queryExecute($sql);
    }

    public function down()
    {
        $connection = Application::getInstance()->getConnection();
        $sql = "drop table if exists test;";
        $connection->queryExecute($sql);
    }
}
