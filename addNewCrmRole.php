<?php
class migration 
{
        static protected $arFields = [
        'NAME'=>'Test Role',
        'RELATION'=>[
            'CONTACT'=>[
                'READ'=>[
                    '-'=>'D'
                ],
                'ADD'=>[
                    '-'=>'D'
                ],
                'WRITE'=>[
                    '-'=>'D'
                ],
                'DELETE'=>[
                    '-'=>'D'
                ],
                'EXPORT'=>[
                    '-'=>'D'
                ],
                'IMPORT'=>[
                    '-'=>'D'
                ],
            ],
            'COMPANY'=>[
                'READ'=>[
                    '-'=>'D'
                ],
                'ADD'=>[
                    '-'=>'D'
                ],
                'WRITE'=>[
                    '-'=>'D'
                ],
                'DELETE'=>[
                    '-'=>'D'
                ],
                'EXPORT'=>[
                    '-'=>'D'
                ],
                'IMPORT'=>[
                    '-'=>'D'
                ],
            ],
            'QUOTE'=>[
                'READ'=>[
                    '-'=>'D'
                ],
                'ADD'=>[
                    '-'=>'D'
                ],
                'WRITE'=>[
                    '-'=>'D'
                ],
                'DELETE'=>[
                    '-'=>'D'
                ],
                'EXPORT'=>[
                    '-'=>'D'
                ],
                'IMPORT'=>[
                    '-'=>'D'
                ],
            ],
            'INVOICE'=>[
                'READ'=>[
                    '-'=>'D'
                ],
                'ADD'=>[
                    '-'=>'D'
                ],
                'WRITE'=>[
                    '-'=>'D'
                ],
                'DELETE'=>[
                    '-'=>'D'
                ],
                'EXPORT'=>[
                    '-'=>'D'
                ],
                'IMPORT'=>[
                    '-'=>'D'
                ],
            ],
            'ORDER'=>[
                'READ'=>[
                    '-'=>'D'
                ],
                'ADD'=>[
                    '-'=>'D'
                ],
                'WRITE'=>[
                    '-'=>'D'
                ],
                'DELETE'=>[
                    '-'=>'D'
                ],
                'EXPORT'=>[
                    '-'=>'D'
                ],
                'IMPORT'=>[
                    '-'=>'D'
                ],
                'AUTOMATION'=>[
                    '-'=>''
                ],
            ],
            'WEBFORM'=>[
                'READ'=>[
                    '-'=>'X'
                ],
                'WRITE'=>[
                    '-'=>'X'
                ],
            ],
            'BUTTON'=>[
                'READ'=>[
                    '-'=>'X'
                ],
                'WRITE'=>[
                    '-'=>'X'
                ],
            ],
            'SALETARGET'=>[
                'READ'=>[
                    '-'=>'D'
                ],
                'WRITE'=>[
                    '-'=>'X'
                ],
            ],
            'EXCLUSION'=>[
                'READ'=>[
                    '-'=>'X'
                ],
                'WRITE'=>[
                    '-'=>''
                ],
            ],
            ///////////
            'DEAL'=>[
                'READ'=>[
                    '-'=>'D',
                    'STAGE_ID'=>[
                        'NEW'=>'-',
                        'PREPARATION'=>'-',
                        'PREPAYMENT_INVOICE'=>'-',
                        'EXECUTING'=>'-',
                        'FINAL_INVOICE'=>'-',
                        'WON'=>'-',
                        'LOSE'=>'-',
                        'APOLOGY'=>'-',
                    ],
                ],
                'ADD'=>[
                    '-'=>'D',
                    'STAGE_ID'=>[
                        'NEW'=>'-',
                        'PREPARATION'=>'-',
                        'PREPAYMENT_INVOICE'=>'-',
                        'EXECUTING'=>'-',
                        'FINAL_INVOICE'=>'-',
                        'WON'=>'-',
                        'LOSE'=>'-',
                        'APOLOGY'=>'-',
                    ],
                ],
                'WRITE'=>[
                    '-'=>'D',
                    'STAGE_ID'=>[
                        'NEW'=>'-',
                        'PREPARATION'=>'-',
                        'PREPAYMENT_INVOICE'=>'-',
                        'EXECUTING'=>'-',
                        'FINAL_INVOICE'=>'-',
                        'WON'=>'-',
                        'LOSE'=>'-',
                        'APOLOGY'=>'-',
                    ],
                ],
                'DELETE'=>[
                    '-'=>'D',
                    'STAGE_ID'=>[
                        'NEW'=>'-',
                        'PREPARATION'=>'-',
                        'PREPAYMENT_INVOICE'=>'-',
                        'EXECUTING'=>'-',
                        'FINAL_INVOICE'=>'-',
                        'WON'=>'-',
                        'LOSE'=>'-',
                        'APOLOGY'=>'-',
                    ],
                ],
                'EXPORT'=>[
                    '-'=>'D',
                    'STAGE_ID'=>[
                        'NEW'=>'-',
                        'PREPARATION'=>'-',
                        'PREPAYMENT_INVOICE'=>'-',
                        'EXECUTING'=>'-',
                        'FINAL_INVOICE'=>'-',
                        'WON'=>'-',
                        'LOSE'=>'-',
                        'APOLOGY'=>'-',
                    ],
                ],
                'IMPORT'=>[
                    '-'=>'D',
                    'STAGE_ID'=>[
                        'NEW'=>'-',
                        'PREPARATION'=>'-',
                        'PREPAYMENT_INVOICE'=>'-',
                        'EXECUTING'=>'-',
                        'FINAL_INVOICE'=>'-',
                        'WON'=>'-',
                        'LOSE'=>'-',
                        'APOLOGY'=>'-',
                    ],
                ],
                'AUTOMATION'=>[
                    '-'=>''
                ],
            ],
            'LEAD'=>[
                'READ'=>[
                    '-'=>'D',
                    'STAGE_ID'=>[
                        'NEW'=>'-',
                        'PREPARATION'=>'-',
                        'PREPAYMENT_INVOICE'=>'-',
                        'EXECUTING'=>'-',
                        'FINAL_INVOICE'=>'-',
                        'WON'=>'-',
                        'LOSE'=>'-',
                        'APOLOGY'=>'-',
                    ],
                ],
                'ADD'=>[
                    '-'=>'D',
                    'STAGE_ID'=>[
                        'NEW'=>'-',
                        'PREPARATION'=>'-',
                        'PREPAYMENT_INVOICE'=>'-',
                        'EXECUTING'=>'-',
                        'FINAL_INVOICE'=>'-',
                        'WON'=>'-',
                        'LOSE'=>'-',
                        'APOLOGY'=>'-',
                    ],
                ],
                'WRITE'=>[
                    '-'=>'D',
                    'STAGE_ID'=>[
                        'NEW'=>'-',
                        'PREPARATION'=>'-',
                        'PREPAYMENT_INVOICE'=>'-',
                        'EXECUTING'=>'-',
                        'FINAL_INVOICE'=>'-',
                        'WON'=>'-',
                        'LOSE'=>'-',
                        'APOLOGY'=>'-',
                    ],
                ],
                'DELETE'=>[
                    '-'=>'D',
                    'STAGE_ID'=>[
                        'NEW'=>'-',
                        'PREPARATION'=>'-',
                        'PREPAYMENT_INVOICE'=>'-',
                        'EXECUTING'=>'-',
                        'FINAL_INVOICE'=>'-',
                        'WON'=>'-',
                        'LOSE'=>'-',
                        'APOLOGY'=>'-',
                    ],
                ],
                'EXPORT'=>[
                    '-'=>'D',
                    'STAGE_ID'=>[
                        'NEW'=>'-',
                        'PREPARATION'=>'-',
                        'PREPAYMENT_INVOICE'=>'-',
                        'EXECUTING'=>'-',
                        'FINAL_INVOICE'=>'-',
                        'WON'=>'-',
                        'LOSE'=>'-',
                        'APOLOGY'=>'-',
                    ],
                ],
                'IMPORT'=>[
                    '-'=>'D',
                    'STAGE_ID'=>[
                        'NEW'=>'-',
                        'PREPARATION'=>'-',
                        'PREPAYMENT_INVOICE'=>'-',
                        'EXECUTING'=>'-',
                        'FINAL_INVOICE'=>'-',
                        'WON'=>'-',
                        'LOSE'=>'-',
                        'APOLOGY'=>'-',
                    ],
                ],
                'AUTOMATION'=>[
                    '-'=>''
                ],
            ],
        ],
    ];


    public function up()
    {
        $obCCrmRole = new \CCrmRole();
        $obCCrmRole->Add(self::$arFields);
    }
    public function down()
    {
        $rsCCrmRole = \CCrmRole::GetList([], ['NAME'=>self::$arFields['NAME']]);
        if($resCCrmRole = $rsCCrmRole->fetch()){
            \CCrmRole::Delete($resCCrmRole['ID']);
        }
    }
}
