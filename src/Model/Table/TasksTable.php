<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TasksTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_action',
        ]);
        $this->belongsTo('Priorities');
    }

    public function getListTaskOfProjectId($project_id) {
        return $this->find('all')->where(['project_id' => $project_id])->contain('Users');
    }
}