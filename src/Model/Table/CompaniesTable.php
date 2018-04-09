<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CompaniesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->hasMany('Projects');
    }

    public function getAll() {
        return $this->find('all')->where(['Companies.status' => '1']);
    }
}
