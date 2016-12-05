<?php
namespace Application\Controllers;

use Application\Core\Controller;
use Application\Models\RegistrationModel;
use Application\Views\RegistrationView;
use CURLFile;

/**
 * Class RegistrationController
 *
 * @package Application\Controllers
 */
class RegistrationController extends Controller
{
    /**
     * @param array $server
     * @param array $request
     */
    public function action(array $server, array $request)
    {
        $view = new RegistrationView();
        $model = new RegistrationModel();
        $data = $model->getData();
        $view->generate($data);
    }
}