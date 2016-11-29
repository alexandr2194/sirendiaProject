<?php
namespace Application\Core;

use Exception;

/**
 * Class Templates
 *
 * @package Application\Core
 */
class Template
{
    /**
     * @var string
     */
    private $workerFileTemplate;
    /**
     * @var array
     */
    private $allMarkers;
    /**
     * @var array
     */
    private $pages;

    /**
     * Templates constructor.
     * @param $path
     */
    public function __construct($path)
    {
        $this->allMarkers = [];
        $this->pages = [];
        $this->setFile($path);
    }

    /**
     * @param $title
     */
    public function createBlock($title)
    {
        $this->pages[$title] = '';
    }

    /**
     * @param $marker
     * @param $value
     * @throws Exception
     */
    public function setMarker($marker, $value)
    {
        if (empty($marker)) {
            throw new Exception("Передан пустой маркер");
        }
        $this->allMarkers[$marker] = $value;
    }

    /**
     * @param $markers
     */
    public function setMarkers($markers)
    {
        foreach ($markers as $marker => $value) {
            $this->setMarker($marker, $value);
        }
    }

    /**
     * @param $title
     */
    public function combine($title)
    {
        $tmpTemplateFile = $this->workerFileTemplate;
        foreach ($this->allMarkers as $marker => $value) {
            $tmpTemplateFile = str_replace('[' . $marker . ']', $value, $tmpTemplateFile);
        }
        if (!array_key_exists($title, $this->pages)) {
            $this->pages[$title] = $tmpTemplateFile;
        } else {
            $this->pages[$title] .= $tmpTemplateFile;
        }
    }

    /**
     * @param $title
     * @return mixed
     * @throws Exception
     */
    public function getBlock($title)
    {
        if (array_key_exists($title, $this->pages)) {
            return $this->pages[$title];
        }
        throw new Exception(sprintf("Страница с названием %s не найдена!", $title));
    }

    /**
     * Загружает файл шаблона
     *
     * @param string $pathToFile
     */
    private function setFile(string $pathToFile)
    {
        $this->assertTemplateFileExist($pathToFile);
        $this->workerFileTemplate = file_get_contents($pathToFile);
    }

    /**
     * @param string $pathToFile
     * @throws Exception
     */
    private function assertTemplateFileExist(string $pathToFile)
    {
        if (!file_exists($pathToFile)) {
            throw new Exception(sprintf("Файла %s не существует!", $pathToFile));
        }
    }
}
