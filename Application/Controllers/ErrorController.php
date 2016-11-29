<?php
namespace Application\Controllers;

use Application\Core\Controller;
use Application\Views\ErrorView;

/**
 * Class ErrorController
 *
 * @package Application\Controllers
 */
class ErrorController extends Controller
{
    public function action(array $server, array $request)
    {
        $view = new ErrorView();
        $view->generate($request);
    }
}