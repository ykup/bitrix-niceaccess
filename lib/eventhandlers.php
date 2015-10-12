<?php
/**
 * @copyright Copyright © 2015 Notamedia Ltd.
 * @license MIT
 */

namespace Notamedia\Niceaccess;

/**
 * Watches if access file was changed
 */
class EventHandlers
{
    public static function onBeforeChangeFile($path, &$strContent)
    {
        $accessFileManager = new AccessFileManager($path, $strContent);

        $strContent = $accessFileManager->replaceFileAccessContent();

        return true;
    }
}