<?php
/**
 * @copyright Copyright © 2015 Notamedia Ltd.
 * @license MIT
 */

namespace Notamedia\Niceaccess;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class EventManager
{
    public static function onBeforeChangeFile($abs_path, &$strContent)
    {
        $accessFileManager = new AccessFileManager($abs_path, $strContent);

        $strContent = $accessFileManager->replaceFileAccessContent();

        return true;
    }

    public static function onBeforeGroupAdd(&$fields)
    {
        global $APPLICATION;

        if(empty($fields['STRING_ID']))
        {
            $APPLICATION->ThrowException(Loc::getMessage('NOTA_NICEACCESS_GROUP_CODE_ERROR_MESSAGE'));
            return false;
        }
    }

    public static function onBeforeGroupUpdate($id, &$fields)
    {
        global $APPLICATION;

        if(empty($fields['STRING_ID']))
        {
            $APPLICATION->ThrowException(Loc::getMessage('NOTA_NICEACCESS_GROUP_CODE_ERROR_MESSAGE'));
            return false;
        }
    }
}