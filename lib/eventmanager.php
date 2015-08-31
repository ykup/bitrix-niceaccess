<?php
/**
 * @copyright Copyright © 2015 Notamedia Ltd.
 * @license MIT
 */

namespace Notamedia\Niceaccess;

class EventManager
{
    public static function onChangePermissions($path, $permission)
    {
        // @todo Вызываем \Notamedia\Niceaccess\AccessFileManager, что бы пересохранить .access.php
    }

    public static function onBeforeGroupAdd(&$fields)
    {
        // @todo Запрещаем сохранять группу без символьного кода
    }

    public static function onBeforeGroupUpdate($id, &$fields)
    {
        // @todo Запрещаем сохранять группу без символьного кода
    }
}