<?php
class ChnageSourceId extends AbstractMigration
{
    public function up()
    {
               if(!\Bitrix\Main\Loader::includeModule('crm') || !\Bitrix\Main\Loader::includeModule('main'))
        {
            return;
        }
        $rs = \CCrmStatus::GetList(
            [],
            [
                'ENTITY_ID'=>'SOURCE',
            ]
        );
        $obCCrmStatus = new \CCrmStatus("SOURCE");
        while ($res = $rs->fetch())
        {
            preg_match("/^[A-Za-z]+/", $res['STATUS_ID'], $matches);
            if(strstr($res['STATUS_ID'], '|') == false && empty($matches))
            {
                $arParams = [
                    "replace_space"=>"_",
                    "replace_other"=>"_",
                    "change_case"=>"U",
                ];
                $translit = \Cutil::translit($res['NAME'],"ru", $arParams);
                if(strlen($translit) > 0)
                {
                    $resultId = $obCCrmStatus->Update(
                        $res['ID'],
                        [
                            'STATUS_ID'=>$translit
                        ],
                        [
                            'ENABLE_STATUS_ID'=>(int)$res['ID']
                        ]
                    );
                    if($resultId)
                    {
                        $rsDealTable = \Bitrix\Crm\DealTable::getList([
                            'filter'=>['SOURCE_ID'=>$res['STATUS_ID']],
                            'select'=>['ID']
                        ]);
                        $idsUpdate = [];
                        while ($resDealTable = $rsDealTable->fetch())
                        {
                            $idsUpdate[] = $resDealTable['ID'];
                        }
                        if(count($idsUpdate)>0)
                        {
                            $sql = "UPDATE `b_crm_deal` SET SOURCE_ID='".$translit."' WHERE ID IN (".implode(",",$idsUpdate).");";
                            $connection = \Bitrix\Main\Application::getInstance()->getConnection();
                            $connection->query($sql);
                        }
                    }
                }
            }
        }
    }
    public function down()
    {
        //
    }
}
