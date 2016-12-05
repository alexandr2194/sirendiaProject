<?php
namespace Application\Views;

use Application\Core\Template;
use Application\Core\View;

/**
 * Class EnterView
 *
 * @package Application\Views
 */
class EnterView extends View
{
    /**
     * @param array $data
     */
    public function generate(array $data = [])
    {
        $templateFile = dirname(__DIR__) . "/Views/Templates/EnterView/index.html";
        $this->assertIssetTemplateFile($templateFile);
        $template = new Template($templateFile);
        $template->setMarkers(['body' => $data['body']]);
        $template->combine("page");
        echo $template->getBlock("page");
    }
}