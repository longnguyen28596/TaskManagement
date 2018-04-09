<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProjectsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->belongsTo('Companies');
        $this->hasMany('UserProjects');
        $this->belongsTo('Teams');
    }

    public function getAll() {
        return $this->find('all')->contain(['Companies' => function($q){
            return $q -> where(['Companies.status' => '1']);
        }]);
    }
    
    public function getView($id) {
        return $this->find('all')->where(['Projects.id' => $id])->contain(['Companies' => function($q){
            return $q -> where();
        }])->first();
    }

    public function getListProjectsManager($user_id) {
        return $this->find()->where(['Projects.status' => '0'])->innerJoinWith('Teams', function($q) use($user_id){
            return $q->where(['Teams.leader' => $user_id]);
        });
    }
}
