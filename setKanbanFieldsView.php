<?php

class lead_for_kanban extends \WS\ReduceMigrations\Scenario\ScriptScenario {

    public function commit() {
        $connection = \Bitrix\Main\Application::getInstance()->getConnection();
        $connection->startTransaction();
        try{
            self::setKanbanViewFields(
                ['ASSIGNED_BY_ID' => 'Test']
            );
        }catch (\Exception $e) {
            $connection->rollbackTransaction();
        }
        $connection->commitTransaction();
    }

    public function rollback() {
        $connection = \Bitrix\Main\Application::getInstance()->getConnection();
        $connection->startTransaction();
        try{
            self::setKanbanViewFields(
                ['ASSIGNED_BY_ID' => 'Responsible person']
            );
        }catch (\Exception $e) {
            $connection->rollbackTransaction();
        }
        $connection->commitTransaction();
    }


    #########################################################################################################

    static private function setKanbanViewFields($arrFields){
        $type = 'lead';
        $categoryId = 0;
        $name = 'kanban_select_more_v4_' . strtolower($type) . '_' . $categoryId. '_common';
        $additionalSelect = \CUserOptions::getOption(
            'crm',
            $name,
            null
        );
        $arValue = $additionalSelect;
        foreach ($arrFields as $code=>$value) {
            $arValue[$code] = $value;
        }
        if(!empty($arValue)){
            \CUserOptions::SetOption(
                'crm',
                $name,
                $arValue,
                true,
                0
            );
        }
    }

}
