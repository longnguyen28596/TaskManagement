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
        $teams = $this->Teams->find()->innerJoinWith('ProjectTeams', function($q) use($project_id){
            return $q->where(['ProjectTeams.project_id' => $project_id, 'ProjectTeams.deleted' => '0']);
        })->toArray();
        $team_id = $teams[0]->id;
        $userProjects = $this->UserProjects->getUserProjectByProjectId($project_id);
        $userTeams = $this->Users->getListUserByTeam($team_id, ['Positions', 'Ratings' => function($q){
            return $q->select(['Ratings.user_id',
                'sum_point' => $this->Ratings->find()->func()->sum('Ratings.point'),
                'count_ratings' => $this->Ratings->find()->func()->count('Ratings.user_id'),
            ])
            ->group('Ratings.user_id');
        }]);
        $current_team_of_user = $this->current_user['team_id'];
        $this->set(compact('teams', 'userProjects', 'userTeams', 'project', 'current_team_of_user'));
    }

    public function ajaxGetUserProjectByTeam($project_id) {
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
        if ($this->current_user['position_id'] == 1 || $this->current_user['position_id'] == 2 || $this->current_user['position_id'] == 5 ) {
            if ($this->request->is('post')) {
                $userProject = $this->UserProjects->find()->where([
                    'user_id' => $_POST['user_id'],
                    'project_id' => $project_id,
                ])->first();
                if ($userProject == array() && $_POST['status'] == 'true') {
                    $this->UserProjects->addNew($_POST['user_id'], $project_id);
                } if ($userProject != array() && $_POST['status'] == 'false') {
                    $a = $this->UserProjects->get($userProject['id']);
                    $a->deleted = '1';
                    $a->out_at = Time::now();
                    $this->UserProjects->save($a);die();
                }
                if ($userProject != array() && $_POST['status'] == 'true') {
                    $a = $this->UserProjects->get($userProject['id']);
                    $a->deleted = '0';
                    $a->out_at = NULL;
                    $this->UserProjects->save($a);die();
                }
                return($this->redirect('/UserProjects/index/'.$project_id));
            }
        } else {
            return($this->redirect('/error/error404/'));
        }
    }

    // lấy danh sách dự án đang tham gia của user hiện tại
    public function getListProjectsJoin() {
        $projects = $this->UserProjects->find()->where(['user_id' => $this->current_user['id'], 'deleted' => '0'])->contain(['Projects' => function($q){
            return $q->contain(['companies']);
        }]);
        $position_current_user = $this->current_user['position_id'];
        $this->set(compact('projects', 'position_current_user'));
    }
}
?>