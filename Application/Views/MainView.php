<?php
namespace Application\Views;

use Application\Core\Template;
use Application\Core\View;

/**
 * Class MainView
 *
 * @package Application\Views
 */
class MainView extends View
{
    /**
     * @param array $data
     */
    public function generate(array $data = [])
    {
        $templateFile = dirname(__DIR__) . "/Views/Templates/MainView/index.html";
        $this->assertIssetTemplateFile($templateFile);
        $template = new Template($templateFile);
        $template->setMarkers([
            'body' => $this->getBodyBlock($data)
        ]);
        $template->combine("page");
        echo $template->getBlock("page");
    }

    private function getBodyBlock(array $data): string
    {
        return $data['body'];
    }
}