<?php
class ImMigration extends AbstractMigration
{
    public function up()
    {
                if(\Bitrix\Main\Loader::includeModule('im'))
        {
            $arSettings = [
                'status' => 'online',
                'backgroundImage' =>'',
                'bxdNotify' => '',
                'sshNotify' => 1,
                'generalNotify' => 1,
                'trackStatus' => '',
                'nativeNotify' => 1,
                'openDesktopFromPanel' => 1,
                'viewOffline' => 1,
                'viewGroup' => 1,
                'viewLastMessage' => 1,
                'enableSound' => 1,
                'enableBigSmile' => 1,
                'enableRichLink' => 1,
                'linesTabEnable' => 1,
                'linesNewGroupEnable' => '',
                'sendByEnter' => 1,
                'correctText' => '',
                'panelPositionHorizontal' => 'right',
                'panelPositionVertical' => 'bottom',
                'loadLastMessage' => 1,
                'loadLastNotify' => 1,
                'notifyAutoRead' => 1,
                'notifyScheme' => 'simple',
                'notifySchemeLevel' => 'important',
                'notifySchemeSendSite' => 1,
                'notifySchemeSendEmail' => 1,
                'notifySchemeSendXmpp' => 1,
                'notifySchemeSendPush' => 1,
                'privacyMessage' => 'all',
                'privacyChat' => 'all',
                'privacyCall' => 'all',
                'privacySearch' => 'all',
                'privacyProfile' => 'all',
            ];
            $arOldSettings = CUserOptions::GetOption('im', CIMSettings::SETTINGS, Array());
            if ($arOldSettings['notifyScheme'] == 'expert' && $arSettings['notifyScheme'] == 'simple')
            {
                $arNotifyValues = CIMSettings::GetSimpleNotifyBlocked();
                $arSettings['notify'] = Array();
                foreach ($arNotifyValues as $settingName => $value)
                {
                    $arSettings['notify'][CIMSettings::CLIENT_SITE.'|'.$settingName] = false;
                    $arSettings['notify'][CIMSettings::CLIENT_XMPP.'|'.$settingName] = false;
                    $arSettings['notify'][CIMSettings::CLIENT_MAIL.'|'.$settingName] = false;
                }
            }

            if (array_key_exists('notify', $arSettings))
            {
                CIMSettings::Set(CIMSettings::NOTIFY, $arSettings['notify']);
                unset($arSettings['notify']);
            }
            CIMSettings::Set(CIMSettings::SETTINGS, $arSettings);
        }
    }
    public function down()
    {
                if(\Bitrix\Main\Loader::includeModule('im'))
        {
            $arSettings = [
                'status' => 'online',
                'backgroundImage' =>'',
                'bxdNotify' => '',
                'sshNotify' => 1,
                'generalNotify' => 1,
                'trackStatus' => '',
                'nativeNotify' => 1,
                'openDesktopFromPanel' => 1,
                'viewOffline' => 1,
                'viewGroup' => 1,
                'viewLastMessage' => 1,
                'enableSound' => 1,
                'enableBigSmile' => 1,
                'enableRichLink' => 1,
                'linesTabEnable' => 1,
                'linesNewGroupEnable' => '',
                'sendByEnter' => 1,
                'correctText' => '',
                'panelPositionHorizontal' => 'right',
                'panelPositionVertical' => 'bottom',
                'loadLastMessage' => 1,
                'loadLastNotify' => 1,
                'notifyAutoRead' => 1,
                'notifyScheme' => 'simple',
                'notifySchemeLevel' => 'important',
                'notifySchemeSendSite' => '',
                'notifySchemeSendEmail' => '',
                'notifySchemeSendXmpp' => 1,
                'notifySchemeSendPush' => '',
                'privacyMessage' => 'all',
                'privacyChat' => 'all',
                'privacyCall' => 'all',
                'privacySearch' => 'all',
                'privacyProfile' => 'all',
            ];
            $arOldSettings = CUserOptions::GetOption('im', CIMSettings::SETTINGS, Array());
            if ($arOldSettings['notifyScheme'] == 'expert' && $arSettings['notifyScheme'] == 'simple')
            {
                $arNotifyValues = CIMSettings::GetSimpleNotifyBlocked();
                $arSettings['notify'] = Array();
                foreach ($arNotifyValues as $settingName => $value)
                {
                    $arSettings['notify'][CIMSettings::CLIENT_SITE.'|'.$settingName] = false;
                    $arSettings['notify'][CIMSettings::CLIENT_XMPP.'|'.$settingName] = false;
                    $arSettings['notify'][CIMSettings::CLIENT_MAIL.'|'.$settingName] = false;
                }
            }

            if (array_key_exists('notify', $arSettings))
            {
                CIMSettings::Set(CIMSettings::NOTIFY, $arSettings['notify']);
                unset($arSettings['notify']);
            }
            CIMSettings::Set(CIMSettings::SETTINGS, $arSettings);
        }
    }
}
