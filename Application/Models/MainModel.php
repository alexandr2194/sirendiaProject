<?php
namespace Application\Models;

/**
 * Class MainModel
 *
 * @package Application\Models
 */
class MainModel
{
    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'body' => "Main page"
        ];
    }
}