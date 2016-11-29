<?php
namespace Application\Core;

use Exception;

/**
 * Class ContentManager
 * @package Application\Core
 */
class FileManager
{
    /**
     * @var string
     */
    private $lastFileName;

    /**
     * @param string $fileName
     * @param string $folder
     * @param string $data
     */
    public function saveDataToFile(string $fileName, string $folder, string $data)
    {
        if (!file_exists($folder)) {
            mkdir($folder);
        }
        $this->lastFileName = $fileName;
        $file = fopen($folder . "/" . $fileName, "w");
        fwrite($file, $data);
        fclose($file);
    }

    /**
     * @return string
     */
    public function getLastFileName():string
    {
        return $this->lastFileName;
    }

    /**
     * @param string $folder
     * @return array
     */
    public function getAllFilesInFolder(string $folder):array
    {
        if (file_exists($folder)) {
            return scandir($folder, 1);
        }
        return [];
    }

    /**
     * @param string $pathToFile
     * @return string
     * @throws Exception
     */
    public function loadFileData(string $pathToFile):string
    {
        if (file_exists($pathToFile)) {
            return file_get_contents($pathToFile);
        }
        throw new Exception("Вы запрашиваете несуществующий файл!");
    }
}