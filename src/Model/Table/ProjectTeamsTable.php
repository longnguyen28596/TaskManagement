<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

class ProjectTeamsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        // $this->belongsTo('Companies');
        // $this->hasMany('UserProjects');
        $this->belongsTo('Teams');
        $this->belongsTo('Projects');
    }

    public function addNew($project_id, $team_id) {
        $projectTeam = [
            'project_id' => $project_id,
            'team_id' => $team_id
        ];
        $projectTeam = $this->newEntity($projectTeam);
        return $this->save($projectTeam);
    }
    
    public function getListProjectsManager($user_id, $team_id) {
        return $this->find()->where(['ProjectTeams.team_id' => $team_id])->contain(['projects'])->innerJoinWith('Teams', function($q) use($user_id) {
            return $q->where(['Teams.leader' => $user_id]);
        });
    }
    
    // public function getView($id) {
    //     return $this->find('all')->where(['Projects.id' => $id])->contain(['Companies' => function($q){
    //         return $q -> where();
    //     }])->first();
    // }

    // public function getListProjectsManager($user_id) {
    //     return $this->find()->where(['Projects.status' => '0'])->innerJoinWith('Teams', function($q) use($user_id){
    //         return $q->where(['Teams.leader' => $user_id]);
    //     });
    // }
}
