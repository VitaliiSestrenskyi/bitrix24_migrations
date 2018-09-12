<?php 


class Migration
{    
    public function commit()
    {
        \Bitrix\Main\Loader::includeModule('sale');
        $arStatusCodes = [
            "C"  =>  "6798c4",
            "CG"  => "a50019",
            "CV"  => "ff0229",
            "F"  =>  "7bb4e7",
            "L"  =>  "9f9f9f",
            "N"  =>  "f1f1f1",
            "O"  =>  "f9506a",
            "U"  =>  "a0c8eb",
            "W"  =>  "b1d898",
        ];
        $rs = \Bitrix\Sale\Internals\StatusTable::getList([
            'filter'=>[ 'ID'=>array_keys($arStatusCodes) ],
            'select'=>['ID']
        ]);
        while ($res = $rs->fetch())
        {
            \Bitrix\Sale\Internals\StatusTable::update(
                $res['ID'],
                [
                    'COLOR'=>'#'.$arStatusCodes[$res['ID']]
                ]
            );
        }
    }

    public function rollback()
    {
        \Bitrix\Main\Loader::includeModule('sale');
        $arStatusCodes = [
            "C"  =>  "Y",
            "CG"  => "Y",
            "CV"  => "Y",
            "F"  =>  "Y",
            "L"  =>  "Y",
            "N"  =>  "Y",
            "O"  =>  "Y",
            "U"  =>  "Y",
            "W"  =>  "Y",
        ];
        $rs = \Bitrix\Sale\Internals\StatusTable::getList([
            'filter'=>[ 'ID'=>array_keys($arStatusCodes) ],
            'select'=>['ID']
        ]);
        while ($res = $rs->fetch())
        {
            \Bitrix\Sale\Internals\StatusTable::update(
                $res['ID'],
                [
                    'COLOR'=>$arStatusCodes[$res['ID']]
                ]
            );
        }
    }
}





