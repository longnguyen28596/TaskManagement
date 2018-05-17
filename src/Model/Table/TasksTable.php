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
        $this->belongsTo('Users', [
            'foreignKey' => 'user_request',
        ]);
        $this->hasMany('Images');
        $this->hasMany('Comments');
        $this->belongsTo('Projects');
    }

    public function getListTaskOfProjectId($project_id) {
        return $this->find('all')->where(['project_id' => $project_id])->contain('Users');
    }

    public function getListTaskByMyTasks($project_id, $user_action) {
        return $this->find('all')->where(['project_id' => $project_id, 'user_action' => $user_action])->contain('Users');
    }
}