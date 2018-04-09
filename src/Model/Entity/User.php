<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class User extends Entity
{
    protected function _setPassword($value)
    {
        if (strlen($value)) {

            return sha1($value);
        }
    }
}