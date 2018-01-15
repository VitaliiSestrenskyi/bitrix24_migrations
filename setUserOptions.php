<?php

class CreateUfTestDealField extends AbstractMigration
{
  private $guid = "deal_details";
  
  public function commit()
    {
        global $USER;

        $oldUserOptions = CUserOptions::GetOption('crm.entity.editor', $this->guid);
        $issetSection = false;
        foreach ($oldUserOptions as $key => $items)
        {
            if($items['name'] == 'testSectionName')
            {
                $issetSection = true;
            }
        }
        if(!$issetSection)
        {
            $arrSection = [
                'name'=>'testSectionName',
                'title'=>'Тестовый раздел',
                'type'=>'section'
            ];
            array_push($oldUserOptions, $arrSection);
            CUserOptions::SetOption('crm.entity.editor', $this->guid, $oldUserOptions, false, $USER->GetID());
            CUserOptions::SetOption('crm.entity.editor', $this->guid, $oldUserOptions, true);
        }
    }



    public function rollback()
    {
        global $USER;

        $oldUserOptions = CUserOptions::GetOption('crm.entity.editor', $this->guid);
        $arrNewUserOptions = [];
        foreach ($oldUserOptions as $key => $items)
        {
            if($items['name'] != 'testSectionName')
            {
                $arrNewUserOptions[$key] = $items;
            }
        }
        CUserOptions::SetOption('crm.entity.editor', $this->guid, $arrNewUserOptions, false, $USER->GetID());
        CUserOptions::SetOption('crm.entity.editor', $this->guid, $arrNewUserOptions, true);
    }


}


