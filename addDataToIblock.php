<?php

class addDataToIblock
{
    protected static $IBLOCK_CODE = "CONFIG_IBLOCK_CODE";

    protected static $arLoadProductArray = [
        [
            "NAME"             => "NEW",
            "CODE"             => "NEW",
            "XML_ID"           => "NEW",
            "ACTIVE"           => "Y",
            "PROPERTY_VALUES"  => [
                'PROP_CODE_1'=>'val1',
                'PROP_CODE_2'=>'val2'
            ],
        ],
    ];


    public function up()
    {
        \Bitrix\Main\Loader::includeModule('iblock');

        $el = new CIBlockElement;

        $resIblock = \CIBlock::GetList(
            Array(),
            Array(
                'TYPE'=>'test_type',
                'ACTIVE'=>'Y',
                "CODE"=>self::$IBLOCK_CODE
            ), true
        )->fetch();
        foreach (self::$arLoadProductArray as $item)
        {
            $item["IBLOCK_ID"] = $resIblock['ID'];
            $el->Add($item);
        }
    }

    public function down()
    {
        $rs = CIBlockElement::GetList(
            Array("SORT"=>"ASC"),
            Array(
                'IBLOCK_CODE'=>self::$IBLOCK_CODE
            ),
            false,
            false,
            Array(
                'ID',
                'IBLOCK_ID'
            )
        );
        while ($res = $rs->fetch())
        {
            CIBlockElement::Delete($res['ID']);
        }
    }
}
