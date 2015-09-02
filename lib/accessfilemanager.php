<?php
/**
 * @copyright Copyright © 2015 Notamedia Ltd.
 * @license MIT
 */

namespace Notamedia\Niceaccess;

/**
 * Implements replacement of user group id's by \Bex\Tools method
 * which returns user group id by symbol code in .access.php files.
 * .access.php will not depend on DB user group id after that
 */
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
            $this->fileContent = preg_replace_callback('/\"G[0-9]+\"/', function($matches){
                $groupId = str_replace('G', '', trim($matches[0], "\""));
                $groupCode = \Bex\Tools\Groups::getCode($groupId);

                return "'G'.\Bex\Tools\Groups::getId('{$groupCode}')";
            }, $this->fileContent);
        }

        return $this->fileContent;
    }
}