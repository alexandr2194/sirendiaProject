<?php
namespace Application\Core;

use Exception;

/**
 * Class View
 *
 * @package Application\Core
 */
abstract class View
{
    /**
     * @param array $data
     */
    abstract public function generate(array $data = []);

    /**
     * @param $templateFile
     * @throws Exception
     */
    protected function assertIssetTemplateFile($templateFile)
    {
        if (!isset($templateFile)) {
            throw new Exception("Шаблон не задан!");
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return get_called_class();
    }
}