<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;
use Cake\I18n\Time;

class TasksController extends AppController
{
    public $paginate = [
        'limit' => 25
    ];
    public $components = ['App'];

    public function listTaskOfProjectId($id) {
        $tasks = $this->Tasks->getListTaskOfProjectId($id);
        $total_record = $this->Tasks->getListTaskOfProjectId($id)->count();
        $this->set('tasks', $this->paginate($tasks));
        $this->set('total_record', $total_record);
    }

    public function listTaskByMyProject($projects_id) {
        $tasks = $this->Tasks->getListTaskByMyTasks($projects_id, $this->current_user['id']);
        $total_record =  $this->Tasks->getListTaskByMyTasks($projects_id, $this->current_user['id'])->count();
        $this->set('tasks', $this->paginate($tasks));
        $this->set('total_record', $total_record);
    }

    // $id = project_id
    public function add($id)
    {
        $user_projects = $this->UserProjects->getUserProjectByProjectId($id);
        if ($this->request->is('post')) {
            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'deadline' => $_POST['deadline'],
                'priority' => $_POST['priority'],
                'user_action' => $_POST['user_action'],
                'user_request' => $this->current_user['id'],
                'project_id' => $id,
            ];
            $data = $this->Tasks->newEntity($data);
            if ($this->Tasks->save($data)) {
                $task = $this->Tasks->save($data);
                if (count($_FILES['files']['name']) >= 1) {
                    $array_image_do_not_upload = explode("|", $_POST['list-image-do-not-upload']);
                    for($i=0; $i< count($_FILES['files']['name']); $i++) {
                        $image=array();
                        if (!in_array($_FILES['files']['name'][$i], $array_image_do_not_upload)) {
                            $url_upload = WWW_ROOT.'/img/admin/tasks/'.$task->id.'/';
                            $file_name = rand();
                            $file_extension = $this->App->get_file_extension($_FILES['files']['name'][$i]);
                            if (!file_exists($url_upload)) {
                                mkdir($url_upload, 0777, true);
                            }
                            $image = [
                                'file_name' => $file_name,
                                'default_name' => $_FILES['files']['name'][$i],
                                'task_id' => $task->id,
                                'size' => $_FILES['files']['size'][$i],
                                'file_extension' => $file_extension
                            ];
                            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $url_upload.$file_name.'.'.$file_extension)) {
                                $this->Images->addNew($image);
                            }
                        }
                    }
                    $this->Flash->Success('Thêm mới nhiệm vụ thành công.');
                    $this->redirect('/Tasks/listTaskOfProjectId/' . $id);
                }
            }
        }
        $this->set(compact(['user_projects', 'id']));
    }

    public function view($id) {
        $task = $this->Tasks->find()->where(['Tasks.id' => $id])->contain('Images')->first();
        if ($task) {
            $user_request = $this->Users->get($task->user_request);
            $user_action = $this->Users->get($task->user_action);
            $comments = $this->Comments->getCommentByTaskID($id);
            $comment_childs = $this->Comments->getCommentByTaskID($id);
            $this->set(compact(['task', 'user_request', 'user_action', 'comments', 'comment_childs']));
        }
    }

    public function delete($id) {
        $task = $this->Tasks->get($id);
        if ($task) {
            if ($this->Tasks->delete($task)) {
                $this->Flash->success("Đã huỷ nhiệm vụ.");
                $this->redirect('/Tasks/listTaskOfProjectId/' . $task->project_id);
            }
        }
    }

    public function edit($id) {
        $task = $this->Tasks->find()->where(['Tasks.id' => $id])->contain('Images')->first();
        $user_projects = $this->UserProjects->getUserProjectByProjectId($task->project_id);
        if ($this->request->is('post')) {
            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'status' => $_POST['status'],
                'deadline' => $_POST['deadline'],
                'priority' => $_POST['priority'],
                'user_action' => $_POST['user_action'],
                'user_request' => $this->current_user['id'],
                'project_id' => $task->project_id,
            ];
            $task = $this->Tasks->patchEntity($task, $data);
            if ($this->Tasks->save($task)) {
                $email = $this->Emails->addNew($task->user_action, $task->id , 'edit task');
                $email->sended_at = Time::now();
                $this->Flash->success("Cập nhập thành công.");
                if (count($_FILES['files']['name']) >= 1) {
                    $array_image_do_not_upload = explode("|", $_POST['list-image-do-not-upload']);
                    for($i=0; $i< count($_FILES['files']['name']); $i++) {
                        $image=array();
                        if (!in_array($_FILES['files']['name'][$i], $array_image_do_not_upload)) {
                            $url_upload = WWW_ROOT.'/img/admin/tasks/'.$task->id.'/';
                            $file_name = rand();
                            $file_extension = $this->App->get_file_extension($_FILES['files']['name'][$i]);
                            if (!file_exists($url_upload)) {
                                mkdir($url_upload, 0777, true);
                            }
                            $image = [
                                'file_name' => $file_name,
                                'default_name' => $_FILES['files']['name'][$i],
                                'task_id' => $task->id,
                                'size' => $_FILES['files']['size'][$i],
                                'file_extension' => $file_extension
                            ];
                            move_uploaded_file($_FILES['files']['tmp_name'][$i], $url_upload.$file_name.'.'.$file_extension);
                            $this->Images->addNew($image);
                        }
                    }
                }
            }
        }
        $this->set(compact(['user_projects', 'id','task']));
    }

    public function editAjax($id) {
        $task = $this->Tasks->get($id);
        if ($task) {
            if (isset($_POST['status'])) {
                $task->status = $_POST['status'];
            } elseif(isset($_POST['done'])) {
                $task->done = $_POST['done'];
            }
            if ($this->Tasks->save($task)) {
                echo $this->AppHelper->successMessage('Sửa trạng thái thành công');die();
            }
        }
    }
}