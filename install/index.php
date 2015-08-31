<?php
/**
 * @copyright Copyright © 2015 Notamedia Ltd.
 * @license MIT
 */

IncludeModuleLangFile(__FILE__);

class notamedia_niceaccess extends CModule
{
    var $MODULE_ID = 'notamedia.niceaccess';
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $PARTNER_NAME;
    var $PARTNER_URI;

    function __construct()
    {
        $arModuleVersion = [];

        include(__DIR__ . '/version.php');

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_NAME = GetMessage('NOTA_NICEACCESS_MODULE_NAME');
        $this->MODULE_DESCRIPTION = GetMessage('NOTA_NICEACCESS_MODULE_DESCRIPTION');
        $this->PARTNER_NAME = GetMessage('NOTA_NICEACCESS_PARTNER_NAME');
        $this->PARTNER_URI = GetMessage('NOTA_NICEACCESS_PARTNER_URI');
    }

    public function DoInstall()
    {
        global $APPLICATION;

        if (version_compare(SM_VERSION, '15.0.2') < 0)
        {
            $APPLICATION->ThrowException(GetMessage('NOTA_NICEACCESS_INSTALL_ERROR_BITRIX_VERSION_MESSAGE'));
        }
        elseif (!class_exists('\Bex\Tools\Groups'))
        {
            $APPLICATION->ThrowException(GetMessage('NOTA_NICEACCESS_INSTALL_ERROR_GROUPS_LIB_MESSAGE'));
        }
        elseif ($groupsWithoutCodes = $this->getGroupsWithoutCodes())
        {
            $APPLICATION->ThrowException(
                GetMessage('NOTA_NICEACCESS_INSTALL_ERROR_GROUPS_WITHOUT_CODES_MESSAGE') . $groupsWithoutCodes
            );
        }
        else
        {
            RegisterModule($this->MODULE_ID);
            $this->RegisterEvents();

            $APPLICATION->IncludeAdminFile(GetMessage('NOTA_NICEACCESS_INSTALL_TITLE'), __DIR__ . '/install_ok.php');

            return true;
        }

        return false;
    }

    /**
     * @return string|null
     */
    protected function getGroupsWithoutCodes()
    {
        // @todo Найти группы пользователей без символьного кода и вернуть ХТМЛ-строку с ссылками на них

        return null;
    }

    protected function RegisterEvents()
    {
        $manager = \Bitrix\Main\EventManager::getInstance();

        $manager->registerEventHandler(
            'main',
            'OnChangePermissions',
            $this->MODULE_ID,
            '\Notamedia\Niceaccess\EventManager',
            'onChangePermissions'
        );

        $manager->registerEventHandler(
            'main',
            'OnBeforeGroupAdd',
            $this->MODULE_ID,
            '\Notamedia\Niceaccess\EventManager',
            'onBeforeGroupAdd'
        );

        $manager->registerEventHandler(
            'main',
            'OnBeforeGroupUpdate',
            $this->MODULE_ID,
            '\Notamedia\Niceaccess\EventManager',
            'onBeforeGroupUpdate'
        );
    }

    public function DoUninstall()
    {
        $this->UnRegisterEvents();

        UnRegisterModule($this->MODULE_ID);
    }

    protected function UnRegisterEvents()
    {
        $manager = \Bitrix\Main\EventManager::getInstance();

        $manager->unRegisterEventHandler(
            'main',
            'OnChangePermissions',
            $this->MODULE_ID,
            '\Notamedia\Niceaccess\EventManager',
            'onChangePermissions'
        );

        $manager->unRegisterEventHandler(
            'main',
            'OnBeforeGroupAdd',
            $this->MODULE_ID,
            '\Notamedia\Niceaccess\EventManager',
            'onBeforeGroupAdd'
        );

        $manager->unRegisterEventHandler(
            'main',
            'OnBeforeGroupUpdate',
            $this->MODULE_ID,
            '\Notamedia\Niceaccess\EventManager',
            'onBeforeGroupUpdate'
        );
    }
}