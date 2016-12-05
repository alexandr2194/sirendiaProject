<?php
namespace Application\Controllers;

use Application\Core\Controller;
use Application\Models\EnterModel;
use Application\Views\EnterView;

/**
 * Class EnterController
 *
 * @package Application\Controllers
 */
class EnterController extends Controller
{
    /**
     * @param array $server
     * @param array $request
     */
    public function action(array $server, array $request)
    {
        $view = new EnterView();
        $model = new EnterModel();
        $data = $model->getData();
        $view->generate($data);
    }
}