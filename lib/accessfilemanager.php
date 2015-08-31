<?php
/**
 * @copyright Copyright © 2015 Notamedia Ltd.
 * @license MIT
 */

namespace Notamedia\Niceaccess;

class AccessFileManager
{
    protected $path;

    /**
     * @param string $path Full path to file .access.php
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Resave file .access.php, with usage symbol of the codes users groups instead id's
     */
    public function resave()
    {
        // @todo Пересохраняем файл .access.php, подменяя в нём айдишники групп пользователей
        // @todo на метод \Bex\Tools\Groups::getId('code')
    }
}