<?php
namespace Application\Controllers;

use Application\Core\Controller;
use Application\Models\BoardModel;
use Application\Views\BoardView;

/**
 * Class BoardController
 *
 * @package Application\Controllers
 */
class BoardController extends Controller
{
    /**
     * @param array $server
     * @param array $request
     */
    public function action(array $server, array $request)
    {
        $view = new BoardView();
        $model = new BoardModel();
        $data = $model->getData();
        $data['current_board'] = $this->getCurrentBoard($server['REQUEST_URI']);
        $view->generate($data);
    }

    /**
     * @param $requestUri
     * @return string
     */
    private function getCurrentBoard($requestUri): string
    {
        $url = explode('/', $requestUri);
        if (isset($url[2])) {
            return $url[2];
        }

        return 'all boards';
    }
}