<?php
namespace Application\Views;

use Application\Core\Template;
use Application\Core\View;

/**
 * Class RegistrationView
 *
 * @package Application\Views
 */
class RegistrationView extends View
{
    /**
     * @param array $data
     */
    public function generate(array $data = [])
    {
        $templateFile = dirname(__DIR__) . "/Views/Templates/RegistrationView/index.html";
        $this->assertIssetTemplateFile($templateFile);
        $template = new Template($templateFile);
        $template->setMarkers(['body' => $data['body']]);
        $template->combine("page");
        echo $template->getBlock("page");
    }
}