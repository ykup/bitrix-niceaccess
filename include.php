<?php
/**
 * @copyright Copyright © 2015 Notamedia Ltd.
 * @license MIT
 */

\Bitrix\Main\Loader::registerAutoLoadClasses('bitrix.niceaccess', [
    '\Notamedia\Niceaccess\EventManager' => 'lib/eventmanager.php',
    '\Notamedia\Niceaccess\AccessFileManager' => 'lib/accessfilemanager.php'
]);