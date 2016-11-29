<?php
namespace Application\Core;

/**
 * Class Controller
 * @package Application\Controllers
 */
abstract class Controller
{
    /**
     * @var Model
     */
    protected $model;
    /**
     * @var View
     */
    protected $view;

    /**
     * @param array $server
     * @param array $request
     */
    abstract public function action(array $server, array $request);

    /**
     * @return string
     */
    public function getName():string
    {
        return get_called_class();
    }
}