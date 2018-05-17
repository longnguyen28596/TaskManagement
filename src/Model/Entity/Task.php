<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Task extends Entity
{
    protected function _setDeadline($value)
    {
        if (strlen($value)) {
            return date('Y-m-d H:i', strtotime(strtr($value, '/', '-')));
        }
    }

    protected function _setCreateAt($value)
    {
        if (strlen($value)) {
            return date('Y-m-d H:i', strtotime(strtr($value, '/', '-')));
        }
    }
}
