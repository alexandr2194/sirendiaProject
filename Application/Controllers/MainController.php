<?php
namespace Application\Controllers;

use Application\Core\Controller;
use Application\Models\MainModel;
use Application\Views\MainView;

/**
 * Class MainController
 * @package Application\Controllers
 */
class MainController extends Controller
{
    /**
     * @param array $server
     * @param array $request
     */
    public function action(array $server, array $request)
    {
        $view = new MainView();
        $model = new MainModel();
        $data = $model->getData();
        $view->generate($data);
    }
}