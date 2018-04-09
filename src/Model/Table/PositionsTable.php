<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PositionsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->hasMany('Users');
    }

    public function getAll() {
        return $this->find('all')->where(['status' => '1']);
    }
}
