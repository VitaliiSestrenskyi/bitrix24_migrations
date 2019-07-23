
<?php
class tMigration extends AbstractMigration
{
    public function up()
    {
        if(!\Bitrix\Main\Loader::includeModule("iblock"))
        {
            return;
        }
        $resIblockTable = \Bitrix\Iblock\IblockTable::getList([
            'filter'=>['CODE'=>"CONFIG_DOCUMENTS_CRM"],
            'select'=>['ID']
        ])->fetch();
        if($resIblockTable)
        {
            global $USER;
            $el = new \CIBlockElement;
            $PROP = array();
            $html = <<<EOD    
<html xml:lang="ua" lang="ua">
EOD;
            $PROP["TEMPLATE_DOCUMENT"] = $html;
            $arLoadProductArray = Array(
                "MODIFIED_BY"    => $USER->GetID(),
                "IBLOCK_SECTION_ID" => false,
                "IBLOCK_ID"      => $resIblockTable['ID'],
                "XML_ID"      => "CALCULATING_RENTAL_COST",
                "CODE"      => "CALCULATING_RENTAL_COST",
                "PROPERTY_VALUES"=> $PROP,
                "NAME"           => "Просчет стоимости проката",
                "ACTIVE"         => "Y",            // активен
                "PREVIEW_TEXT"   => "",
                "DETAIL_TEXT"    => "",
                "DETAIL_PICTURE" => "",
                "WF_STATUS_ID" => 1,
            );
            if($PRODUCT_ID = $el->Add($arLoadProductArray))
            {
                echo "New ID: ".$PRODUCT_ID;
            }
        }
    }
 
    public function down()
    {
        if(!\Bitrix\Main\Loader::includeModule("iblock"))
        {
            return;
        }
        $resIblockTable = \Bitrix\Iblock\IblockTable::getList([
            'filter'=>['CODE'=>"CONFIG_DOCUMENTS_CRM"],
            'select'=>['ID']
        ])->fetch();
        if($resIblockTable)
        {
            global $DB;
            $rs = \CIBlockElement::GetList(
                [],
                [
                    'IBLOCK_ID'=>$resIblockTable['ID'],
                    'CODE'=>"TEST",
                ],
                false,
                false,
                [
                    'ID',
                    'IBLOCK_ID'
                ]
            );
            if($res = $rs->fetch())
            {
                $DB->StartTransaction();
                if(!\CIBlockElement::Delete($res['ID']))
                {
                    $DB->Rollback();
                }
                else
                {
                    $DB->Commit();
                }
            }
        }    
    }
}    
