<?php
namespace Application\Core;

/**
 * Class Model
 * @package Application\Core
 */
abstract class Model
{
    /**
     * @return array
     */
    abstract public function getData():array;

    /**
     * @return string
     */
    public function getName():string
    {
        return get_called_class();
    }
}