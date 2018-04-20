<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class EmailsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->belongsTo('Users');
    }

    public function addNew($user_id, $variable, $type) {
        $email = [
            'user_id' => $user_id,
            'variable' => $variable,
            'type' => $type
        ];
        $email = $this->newEntity($email);
        return $this->save($email); 
    }
}