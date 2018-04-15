<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;
use Cake\I18n\Time;

class TasksController extends AppController
{
    public $paginate = [
        'limit' => 10
    ];

    public function listTaskOfProjectId($id) {
        $tasks = $this->Tasks->getListTaskOfProjectId($id);
        $total_record = $this->Tasks->getListTaskOfProjectId($id)->count();
        
        $this->set('tasks', $this->paginate($tasks));
        $this->set('total_record', $total_record);
    }

    public function add($id)
    {
        $user_projects = $this->userProjectsModel->getUserProjectByProjectId($id);
        if ($this->request->is('post')) {
            $data['title'] = $_POST['title'];
            $data['description'] = $_POST['description'];
            $data['deadline'] = $_POST['deadline'];
            $data['priority'] = $_POST['priority'];
            $data['user_action'] = $_POST['user_action'];
            $data['user_request'] = $this->current_user['id'];
            $data['project_id'] = $id;
            $data = $this->Tasks->newEntity($data);
            if ($this->Tasks->save($data)) {
                echo "<script>alert('Thêm mới thành công.')</script>";
            }
        }
        $this->set(compact(['user_projects', 'id']));
    }

    public function view($id) {
        $task = $this->Tasks->find()->where(['Tasks.id' => $id])->first();
        $user_request = $this->usersModel->get($task->user_request);
        $user_action = $this->usersModel->get($task->user_action);
        $this->set(compact(['task', 'user_request', 'user_action']));
    }

    public function edit($id) {
        $task = $this->Tasks->get($id);
        $user_projects = $this->userProjectsModel->getUserProjectByProjectId($task->project_id);
        if ($this->request->is('post')) {
            $data['title'] = $_POST['title'];
            $data['description'] = $_POST['description'];
            $data['status'] = $_POST['status'];
            $data['priority_id'] = $_POST['priority_id'];
            $data['user_action'] = $_POST['user_action'];
            $data['user_request'] = $this->current_user['id'];
            $data['project_id'] = $id;
            $task = $this->Tasks->patchEntity($task, $data);
            if ($this->Tasks->save($task)) {
                echo "<script>alert('Sửa mới thành công.')</script>";
            }
        }
        $this->set(compact(['user_projects', 'id','task']));
    }
}