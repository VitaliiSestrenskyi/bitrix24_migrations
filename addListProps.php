<?php
class AddProps extends AbstractMigration
{
    public function up()
    {
          \Bitrix\Main\Loader::includeModule('lists');
          $iblockId = 94;
          $obList = new CList( $iblockId );
          $arFields = $obList->GetFields();
          $allListsFields = [
              [
                  "SORT" => 400,
                  "NAME" => "Дата создания элемента",
                  "IS_REQUIRED" => "N",
                  "MULTIPLE" => "N",
                  "CODE" => "CREATED_AT",
                  "TYPE" => "S:DateTime",
                  "DEFAULT_VALUE" => "",
                  "USER_TYPE_SETTINGS" => "",
                  "SETTINGS" => [
                      "SHOW_ADD_FORM" => "Y",
                      "SHOW_EDIT_FORM" => "Y",
                      "ADD_READ_ONLY_FIELD" => "N",
                      "EDIT_READ_ONLY_FIELD" => "N",
                      "SHOW_FIELD_PREVIEW" => "N",
                  ],
                  "LIST" =>[],
              ],
          ];
          foreach ($allListsFields as $allListsField)
          {
              $obList->AddField($allListsField);
          }
          global $CACHE_MANAGER;
          $CACHE_MANAGER->ClearByTag("lists_list_".$iblockId);
    }
    public function down()
    {
        //
    }
}
