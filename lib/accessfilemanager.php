<?php
/**
 * @copyright Copyright © 2015 Notamedia Ltd.
 * @license MIT
 */

namespace Notamedia\Niceaccess;

class AccessFileManager
{
    protected $path;
    protected $fileContent;

    /**
     * @param string $path Full path to file .access.php
     * @param string $fileContent Content of file
     */
    public function __construct($path, $fileContent)
    {
        $this->path = $path;
        $this->fileContent = $fileContent;
    }

    /**
     * Resave file .access.php, with usage symbol of the codes users groups instead id's
     */
    public function replaceFileAccessContent()
    {
        $fileName = '.access.php';
        if(strlen($this->path) >= strlen($fileName) && substr($this->path, -strlen($fileName)) == $fileName)
        {
            // @todo Пересохраняем файл .access.php, подменяя в нём айдишники групп пользователей
            // @todo на метод \Bex\Tools\Groups::getId('code')
            return $this->fileContent;
        }

        return $this->fileContent;
    }
}