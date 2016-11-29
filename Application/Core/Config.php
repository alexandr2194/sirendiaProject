<?php
namespace Application\Core;

use Exception;

/**
 * Class Configs
 * @package Application\Configs
 */
class Config
{
    /**
     * @var array
     */
    private $configData;
    /**
     * @var string
     */
    private $pathToConfigFile;

    /**
     * @param string $pathToConfigFile
     * @return Config
     */
    public static function buildConfigFromFile(string $pathToConfigFile):self
    {
        self::assertExistsFile($pathToConfigFile);
        $config = new self();
        $config->pathToConfigFile = $pathToConfigFile;
        $config->configData = json_decode(file_get_contents($pathToConfigFile), true);
        $config->assertCorrectJsonDecode();
        return $config;
    }

    /**
     * @return bool
     */
    public function getShowErrorsOption():bool
    {
        return $this->configData['global']['display_errors'];
    }

    /**
     * Config constructor.
     */
    private function __construct()
    {
    }

    /**
     * @throws Exception
     */
    private function assertCorrectJsonDecode()
    {
        if (!(json_last_error() == JSON_ERROR_NONE)) {
            throw new Exception(json_last_error_msg());
        }
    }

    /**
     * @param string $pathToFile
     * @throws Exception
     */
    private static function assertExistsFile(string $pathToFile)
    {
        if (!file_exists($pathToFile)) {
            throw new Exception(sprintf("Путь до файла с конфигурацией '%s' указан неверно!", $pathToFile));
        }
    }
}