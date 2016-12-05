<?php
namespace Application\Models;

use Application\Core\Model;

/**
 * Class RegistrationModel
 *
 * @package Application\Models
 */
class RegistrationModel extends Model
{
    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'body' => "Registration page"
        ];
    }
}