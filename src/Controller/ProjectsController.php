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
            $project = $this->Projects->newEntity($this->request->getData());
            if ($this->Projects->save($project)) {
                // cập nhập lại session quản lý dự án
                if ($this->session->read('listProjectManager') != NULL) {
                    $this->session->delete('listProjectManager');
                    $listProjectManager = $this->Projects->getListProjectsManager($this->current_user['id'])->toArray();
                    $this->session->write('listProjectManager', $listProjectManager);
                }
                echo "<script>alert('Thêm mới thành công.')</script>";
            }
        }
        $this->set(compact('teams', 'companies'));
    }

    public function edit($id) {
        $teams = $this->Teams->find('all')->where(['status' => '1']);
        $companies = $this->Companies->getAll();
        $project = $this->Projects->find()->where(['id' => $id])->first();
        if ($this->request->is('post')) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($this->Projects->save($project)) {
                echo "<script>alert('Sửa thành công.')</script>";
            }
        }
        $this->set(compact('teams', 'companies', 'project'));

    }
}
?>
