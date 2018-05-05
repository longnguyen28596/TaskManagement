<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Project extends Entity
{
    protected function _setTimeRelease($value)
    {
        if (strlen($value)) {
            return date('Y-m-d H:i', strtotime(strtr($value, '/', '-')));
        }
    }
}