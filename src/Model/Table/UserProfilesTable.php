<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UserProfilesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        // $this->belongsTo('Users');
    }

    public function getAll() {
        return $this->find('all');
    }
}