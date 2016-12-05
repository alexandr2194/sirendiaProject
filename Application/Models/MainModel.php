<?php
namespace Application\Models;

use Application\Core\Model;

/**
 * Class MainModel
 *
 * @package Application\Models
 */
class MainModel extends Model
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