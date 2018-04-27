<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TeamsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->hasMany('Users');
        $this->hasMany('Projects');
        $this->hasMany('ProjectTeams');
    }

    public function validationDefault(Validator $validator)
    {

        $validator
            ->maxLength('name', 255)
            ->notEmpty('name');

        return $validator;
    }

    public function getAll() {
        return $this->find('all')->where(['status' => '1']);
    }
}