<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;
use Cake\I18n\Time;

class ProjectsController extends AppController
{
    public $paginate = [
        'limit' => 10
    ];

    public function index() {
        if ($this->current_user['position_id'] == 1 || $this->current_user['position_id'] == 2 || $this->current_user['position_id'] == 5) {
            $projects = $this->Projects->getAll();
            $this->set('projects', $this->paginate($projects));
        } else {
            return($this->redirect('/error/error404/'));
        }
    }    

    public function view($id) {
        $project = $this->Projects->getView($id);
        $userProjects = $this->UserProjects->getAllUserProjectByProjectId($id);
        $this->set(compact('userProjects', 'project'));
    }

    public function delete($id) {
        if ($this->current_user['position_id'] == 1 || $this->current_user['position_id'] == 2) {
            $project = $this->Projects->get($id);
            $userProjects = $this->UserProjects->getAllUserProjectByProjectId($id);
            $projectTeams = $this->ProjectTeams->find('all')->where(['project_id' => $id]);
            if($project) {
                $this->Projects->delete($project);
                if($userProjects){
                    foreach ($userProjects as $userProject) {
                        $this->UserProjects->delete($userProject);
                    }
                }
                if(!is_null($projectTeams)){
                    foreach ($projectTeams as $projectTeam) {
                        $this->ProjectTeams->delete($projectTeam);
                    }
                }
                $this->Flash->success("Xoá dự án thành công");
                $this->redirect('/Projects/index');
            }
        } else {
            return($this->redirect('/error/error404/'));
        }
    }

    public function add() {
        if ($this->current_user['position_id'] == 1 || $this->current_user['position_id'] == 2) {
            $teams = $this->Teams->find('all')->where(['status' => '1']);
            $companies = $this->Companies->getAll();
            if ($this->request->is('post')) {
                $project = $this->Projects->addNew($_POST['name'], $_POST['company_id'], $_POST['description'], $_POST['priority'], $_POST['release'], $_POST['id_name']);
                if ($project) {
                    $team_ids = $_POST['teams'];
                    foreach ($team_ids as $team_id) {
                        $this->ProjectTeams->addNew($project->id, $team_id);
                        $team = $this->Teams->get($team_id);
                        $this->UserProjects->addNew($team->leader, $project->id);
                    }
                    $this->Flash->success("Thêm mới thành công.");
                    $this->redirect('/Projects/index');
                }
            }
            $this->set(compact('teams', 'companies'));
        } else {
            return($this->redirect('/error/error404/'));
        }
    }

    public function edit($id) {
        if ($this->current_user['position_id'] == 1 || $this->current_user['position_id'] == 2 || $this->current_user['position_id'] == 5) {
            $teams = $this->Teams->find('all')->where(['status' => '1'])->select(['id', 'name']);
            $companies = $this->Companies->getAll();
            $project = $this->Projects->find()->where(['id' => $id, 'status' => '0'])->first();
            $projectTeams = ($this->ProjectTeams->find()->where(['ProjectTeams.project_id' => $project->id]));
            if ($this->request->is('post')) {
                $data = [
                    'name' => $_POST['name'],
                    'company_id' => $_POST['company_id'],
                    'description' => $_POST['description'],
                    'priority' => $_POST['priority'],
                    'time_release' => $_POST['release'],
                    'id_name' => $_POST['id_name'],
                ];
                $project = $this->Projects->patchEntity($project, $data);
                foreach ($projectTeams as $projectTeam) {
                    $this->ProjectTeams->delete($projectTeam);
                }
                if (isset($_POST['teams']) && $_POST['teams'] != []) {
                    foreach ($_POST['teams'] as $team_project) {
                        $this->ProjectTeams->addNew($project->id, $team_project);
                        $team = $this->Teams->get($team_project);
                        $this->UserProjects->addNew($team->leader, $project->id);
                    }
                }
                if ($this->Projects->save($project)) {
                    $this->Flash->success("Cập nhập thành công.");
                    $this->redirect('/Projects/index');
                }
            }
            $this->set(compact('teams', 'companies', 'project', 'projectTeams'));
        } else {
            return($this->redirect('/error/error404/'));
        }
    }
}
?>
