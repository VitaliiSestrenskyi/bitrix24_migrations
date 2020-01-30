<?php

class tasks extends \WS\ReduceMigrations\Scenario\ScriptScenario {

    private $arBPFields = [
        'DOCUMENT_TYPE' => [
            'crm',
            'CCrmDocumentLead',
            'LEAD',
        ],
        'AUTO_EXECUTE' => 0,
        'NAME' => 'TEST',
        'CODE' => 'TEST',
    ];

    /**
     * Write action by apply scenario. Use method `setData` for save need rollback data
     **/
    public function commit() {
        self::deleteTemplate();
        $pathBPElement = $_SERVER['DOCUMENT_ROOT'].'/local/static/dataForMigration/bp-35.bpt';
        $id = $this->importBP($pathBPElement);
    }

    /**
     * Write action by rollback scenario. Use method `getData` for getting commit saved data
     **/
    public function rollback() {
        //
    }

    private function deleteTemplate(){
        if (\Bitrix\Main\Loader::includeModule('bizproc')){
            $r = \Bitrix\Bizproc\WorkflowTemplateTable::getList([
                'select' => ['ID'],
                'filter' => [
                    '=SYSTEM_CODE' => $this->arBPFields['CODE'],
                    '=NAME' => 'TEST',
                    '=MODULE_ID' => 'crm',
                    '=ENTITY' => 'CCrmDocumentLead',
                    '=DOCUMENT_TYPE' => 'LEAD',
                    '=DOCUMENT_STATUS' => '',
                    '=ACTIVE' => 'Y'
                ]
            ]);
            if ($bpt = $r->fetch()){
                \CBPWorkflowTemplateLoader::Delete($bpt['ID']);
            }
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////

    private function importBP($path){
        CModule::IncludeModule('bizproc');
        CModule::IncludeModule('crm');

        // Get BP id by the CODE
        $result = \CBPWorkflowTemplateLoader::GetList(
            [],
            [
                'NAME' => 'ADMIN_TASKS',
                'CODE'      => $this->arBPFields['CODE'],
                'MODULE_ID' => 'crm'
            ]
        );
        $id = 0;
        if ($arFields = $result->GetNext()) {
            $id = $arFields['ID'];
        }
        if($id === 0){
            //read file to a variable
            $f = fopen($path, 'rb');
            $datum = fread($f, filesize($path));
            fclose($f);

            //Update BP if id>0, otherwise add BP
            \CBPWorkflowTemplateLoader::ImportTemplate(
                (int)$id,
                $this->arBPFields['DOCUMENT_TYPE'],
                $this->arBPFields['AUTO_EXECUTE'],
                $this->arBPFields['NAME'],
                '',
                $datum,
                $this->arBPFields['CODE']
            );

            return $arFields['ID'];
        }
    }




}
