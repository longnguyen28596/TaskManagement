<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;
use Cake\I18n\Time;

class UserProjectsController extends AppController
{
    public $paginate = [
        'limit' => 20
    ];
    
    public function index($project_id)
    {
        $project = $this->Projects->get($project_id);
        // $teams = $this->Teams->find()->contain(['ProjectTeams' => function($q) use($project_id){
        //     return $q->where(['ProjectTeams.project_id' => $project_id]);
        // }])->toArray();
        $teams = $this->Teams->find()->innerJoinWith('ProjectTeams', function($q) use($project_id){
            return $q->where(['ProjectTeams.project_id' => $project_id]);
        })->toArray();
            //     return $this->find()->where(['Projects.status' => '0'])->innerJoinWith('Teams', function($q) use($user_id){
    //         return $q->where(['Teams.leader' => $user_id]);
    //     });
        $team_id = $teams[0]->id;
        // if ($this->request->is('post')) {
        //     $team_id = $_POST['team_id'];
        //     $team = $this->Teams->get($project->team_id);
        // }
        $userProjects = $this->UserProjects->getUserProjectByProjectId($project_id);
        $userTeams = $this->Users->getListUserByTeam($team_id, ['Positions']);
        $this->set(compact('teams', 'userProjects', 'userTeams', 'project'));
        // $team = $this->Teams->get($project->team_id);
        // $userProjects = $this->UserProjects->getUserProjectByProjectId($project_id);
        // $userTeams = $this->Users->getListUserByTeam($project->team_id, ['Positions']);
        // $this->set(compact('project', 'userProjects', 'team','userTeams'));
    }

    public function ajaxGetUserProjectByTeam($project_id) {
        // $teams = $this->Teams->find()->contain(['ProjectTeams' => function($q) use($project_id){
        //     return $q->where(['ProjectTeams.project_id' => $project_id]);
        // }])->toArray();
        //  $team_id = $teams[0]->id;
        $teams = $this->Teams->find()->contain(['ProjectTeams' => function($q) use($project_id){
            return $q->where(['ProjectTeams.project_id' => $project_id]);
        }])->toArray();
        if ($this->request->is('post')) {
            $userProjects = $this->UserProjects->getUserProjectByProjectId($project_id);
            $userTeams = $this->Users->getListUserByTeam($_POST['team_id'], ['Positions']);
            $this->set(compact('userProjects', 'teams', 'userTeams', 'project_id'));
        }
        $this->set(compact('teams'));

    }

    public function add($project_id) {
        if ($this->request->is('post')) {
            $userProject = $this->UserProjects->find()->where([
                'user_id' => $_POST['user_id'],
                'project_id' => $project_id,
            ])->first();
            if ($userProject == array() && $_POST['status'] == 'true') {
                $this->UserProjects->addNew($_POST['user_id'], $project_id);
            } if ($userProject != array() && $_POST['status'] == 'false') {
                $a = $this->UserProjects->get($userProject['id']);
                $this->UserProjects->delete($a);die();
            }
            return($this->redirect('/UserProjects/index/'.$project_id));
        }
    }
}
?>