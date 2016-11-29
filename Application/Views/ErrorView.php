<?php
namespace Application\Views;

use Application\Core\Template;
use Application\Core\View;

/**
 * Class ErrorView
 *
 * @package Application\Views
 */
class ErrorView extends View
{
    /**
     * @param array $data
     */
    public function generate(array $data = [])
    {
        $templateFile = dirname(__DIR__) . "/Views/Templates/ErrorView/index.html";
        $this->assertIssetTemplateFile($templateFile);
        $template = new Template($templateFile);
        $template->setMarkers(['error_message' => $data['error_message']]);
        $template->combine("page");
        echo $template->getBlock("page");
    }
}