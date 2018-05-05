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

    public function index(){
        $projects = $this->Projects->getAll();
        $this->set('projects', $this->paginate($projects));
    }    

    public function view($id) {
        $project = $this->Projects->getView($id);
        $userProjects = $this->UserProjects->getAllUserProjectByProjectId($id);
        $this->set(compact('userProjects', 'project'));
    }

    public function add() {
        $teams = $this->Teams->find('all')->where(['status' => '1']);
        $companies = $this->Companies->getAll();
        if ($this->request->is('post')) {
            $project = $this->Projects->addNew($_POST['name'], $_POST['company_id'], $_POST['description'], $_POST['priority'], $_POST['release']);
            if ($project) {
                $team_ids = $_POST['teams'];
                foreach ($team_ids as $team_id) {
                    $this->ProjectTeams->addNew($project->id, $team_id);
                }
                $this->Flash->success("Thêm mới thành công.");
                $this->redirect('/Projects/index');
            }
        }
        $this->set(compact('teams', 'companies'));
    }

    public function edit($id) {
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
                'time_release' => $_POST['release']
            ];
            $project = $this->Projects->patchEntity($project, $data);
            foreach ($projectTeams as $projectTeam) {
                $this->ProjectTeams->delete($projectTeam);
            }
            if (isset($_POST['teams']) && $_POST['teams'] != []) {
                foreach ($_POST['teams'] as $team_project) {
                    $this->ProjectTeams->addNew($project->id, $team_project);
                }
            }
            if ($this->Projects->save($project)) {
                $this->Flash->success("Cập nhập thành công.");
                $this->redirect('/Projects/index');
            }
        }
        $this->set(compact('teams', 'companies', 'project', 'projectTeams'));
    }
}
?>
