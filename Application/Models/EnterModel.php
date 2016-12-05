<?php
namespace Application\Models;

use Application\Core\Model;

/**
 * Class EnterModel
 *
 * @package Application\Models
 */
class EnterModel extends Model
{
    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'body' => "Enter page"
        ];
    }
}