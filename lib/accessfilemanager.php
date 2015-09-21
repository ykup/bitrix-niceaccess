<?php
/**
 * @copyright Copyright © 2015 Notamedia Ltd.
 * @license MIT
 */

namespace Notamedia\Niceaccess;

use Bex\Tools\Groups;

/**
 * Implements replacement of user group id's by \Bex\Tools method which returns user group id by symbol code
 * in .access.php files. File .access.php will not depend on DB user group id after that
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

        if (strlen($this->path) >= strlen($fileName) && substr($this->path, -strlen($fileName)) == $fileName)
        {
            $this->fileContent = preg_replace_callback('/(PERM\[.+\]\[)(\"G?[0-9]+\")(\])/', function ($matches)
            {
                $matches[2] = trim($matches[2], "\"");
                $groupId = str_replace('G', '', $matches[2], $addG);
                $groupCode = Groups::getCode($groupId);

                return $matches[1] . ($addG ? "'G'." : '') . "\Bex\Tools\Groups::getId('{$groupCode}')" . $matches[3];
            }, $this->fileContent);
        }

        return $this->fileContent;
    }
}