<?php
namespace Application\Views;

use Application\Core\Template;
use Application\Core\View;

/**
 * Class BoardView
 *
 * @package Application\Views
 */
class BoardView extends View
{
    /**
     * @param array $data
     */
    public function generate(array $data = [])
    {
        $templateFile = dirname(__DIR__) . "/Views/Templates/BoardView/index.html";
        $this->assertIssetTemplateFile($templateFile);
        $template = new Template($templateFile);
        $template->setMarkers(['current_board' => $data['current_board']]);
        $template->combine("page");
        echo $template->getBlock("page");
    }
}