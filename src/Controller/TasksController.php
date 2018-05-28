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
        $project = $this->Projects->find()->select(['name'])->where(['id' => $id])->first();
        $this->set('tasks', $tasks);
        $this->set('project', $project);
    }

    public function listTaskByTeam(){
        $team = $this->Teams->get($_GET['team_id']);
        $project = $this->Projects->find()->select(['name'])->where(['id' => $_GET['project_id']])->first();
        $tasks = $this->Tasks->find()->where(['user_request' => $team->leader, 'project_id' => $_GET['project_id']])->contain("Users");
        $this->set('tasks', $tasks);
        $this->set('project', $project);
    }

    public function changeStatus($id){
        $task = $this->Tasks->get($id);
        $this->set('task', $task);
        $this->set('current_user_id', $this->current_user['id']);
        if ($this->request->is('post')) {
            if ($_POST['status'] == 'Yêu cầu kiểm tra') {
                $this->Messages->addNew($task['user_request'], $this->current_user['name'].' yêu cầu kiểm tra.', '/tasks/view/'.$task['id']);
            }
            if ($_POST['status'] == 'Yêu cầu làm lại') {
                $this->Messages->addNew($task['user_action'], $this->current_user['name'].' đã kiểm tra và yêu cầu xem lại.', '/tasks/view/'.$task['id']);
            }
            if ($_POST['status'] == 'Đã xong') {
                $this->Messages->addNew($task['user_action'], $this->current_user['name'].' đã kiểm tra và xác nhận hoàn thành.', '/tasks/view/'.$task['id']);
                $task->daydone = Time::now();
                $task->progress = 100;
            }
            $task->status = $_POST['status'];
            $task->progress = $_POST['progress'];
            $this->Tasks->save($task);
        }
    }

    public function listTaskByMyProject($projects_id) {
        $tasks = $this->Tasks->getListTaskByMyTasks($projects_id, $this->current_user['id']);
        $this->set('tasks', $tasks);
    }

    public function filterListMyTask() {
        $project_id = $_POST['project_id'];
        if ($_POST['from_tab'] == 'tab2') {
            if ($project_id == 0) {
                $tasks = $this->Tasks->find()->where(['status != "Đã xong"', 'user_request' => $this->current_user['id']])->order(['deadline' => 'asc']);
            } else {
                // để load xem tất cả cho tab2
                $tasks = $this->Tasks->find()->where(['status != "Đã xong"', 'user_request' => $this->current_user['id'], 'project_id' => $project_id])->order(['deadline' => 'asc']);
            }
        }

        if ($_POST['from_tab'] == 'tab3') {
            if ($project_id == 0) {
                $tasks = $this->Tasks->find()->where(['status != "Đã xong"', 'user_action' => $this->current_user['id']])->order(['deadline' => 'asc']);
            } else {
                $tasks = $this->Tasks->find()->where(['status != "Đã xong"', 'user_action' => $this->current_user['id'], 'project_id' => $project_id])->order(['deadline' => 'asc']);
            }
        }
        $this->set('tasks', $tasks);
    }
    // $id = project_id
    public function add($id)
    {
        if ($this->current_user['position_id'] == 1 || $this->current_user['position_id'] == 2 || $this->isLeader == 1) {
            $user_projects = $this->UserProjects->getUserProjectByProjectId2($id, $this->current_user['team_id']);
            $project = $this->Projects->find()->where(['id' => $id])->select('name')->first();
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
                    $email = $this->Emails->addNew($task->user_action, $task->id , 'new task');
                    $email->sended_at = Time::now();
                    $this->Messages->addNew($task['user_action'], $this->current_user['name'].' đã thêm 1 nhiệm vụ cho bạn', '/tasks/view/'.$task['id']);
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
            $this->set(compact(['user_projects', 'id', 'project']));
        } else {
            return($this->redirect('/error/error404/'));
        }
    }

    public function view($id) {
        $task = $this->Tasks->find()->where(['Tasks.id' => $id])->contain('Images')->first();
        $hidecomment = isset($_GET['hidecomment']) ? $_GET['hidecomment'] : '0';
        if ($task) {
            $current_user_id = $this->current_user['id'];
            $user_request = $this->Users->get($task->user_request);
            $user_action = $this->Users->get($task->user_action);
            $comments = $this->Comments->getCommentByTaskID($id);
            $comment_childs = $this->Comments->getCommentByTaskID($id);
            $point = $this->Ratings->find()->where(['user_id' => $task->user_action, 'task_id' => $task->id])->first();
            $this->set(compact(['current_user_id', 'hidecomment', 'task', 'user_request', 'user_action', 'comments', 'comment_childs', 'point']));
        }
    }

    public function delete($id) {
        if ($this->current_user['position_id'] == 1 || $this->current_user['position_id'] == 2 || $this->isLeader == 1) {
            $task = $this->Tasks->get($id);
            if ($task) {
                if ($this->Tasks->delete($task)) {
                    $this->Flash->success("Đã huỷ nhiệm vụ.");
                    $this->redirect('/Tasks/listTaskOfProjectId/' . $task->project_id);
                }
            }
        } else {
            return($this->redirect('/error/error404/'));
        }
    }

    public function edit($id) {
        if ($this->current_user['position_id'] == 1 || $this->current_user['position_id'] == 2 || $this->isLeader == 1) {
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
                    $this->Messages->addNew($task['user_action'], $this->current_user['name'].' đã thay đổi nhiệm vụ', '/tasks/view/'.$task['id']);
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
        } else {
            return($this->redirect('/error/error404/'));
        }
    }

    public function editAjax($id) {
        $task = $this->Tasks->get($id);
        if ($task) {
            if (isset($_POST['status'])) {
                $task->status = $_POST['status'];
                if ($_POST['status'] == 'Kiểm tra') {
                    $this->Messages->addNew($task['user_request'], $this->current_user['name'].' đã yêu cầu kiểm tra nhiệm vụ ', '/tasks/view/'.$task['id']);                    
                }
            } elseif(isset($_POST['done'])) {
                $task->done = $_POST['done'];
                if ($_POST['done'] == 'Hoàn thành') {
                    $this->Messages->addNew($task['user_action'], $this->current_user['name'].' xác nhân nhiệm vụ đã hoàn thành ', '/tasks/view/'.$task['id']);
                } else {
                    $this->Messages->addNew($task['user_action'], $this->current_user['name'].' đề kiểm tra lại nhiệm vụ', '/tasks/view/'.$task['id']);
                }
            }
            if ($this->Tasks->save($task)) {
                echo $this->AppHelper->successMessage('Sửa trạng thái thành công');die();
            }
        }
    }

    public function report(){
        if ($this->current_user['position_id'] == 1 || $this->current_user['position_id'] == 2 || $this->isLeader == 1) {
            $teams = $this->Teams->getAll();
            $users = $this->Users->getAll();
            $where_user = [];
            $where_task = [];
            $where_sum_task_da_xong_dung_tien_dos = ['Tasks.status' => 'Đã xong', 'Tasks.daydone <= Tasks.deadline'];
            $where_sum_task_da_xong_cham_tien_dos = ['Tasks.status' => 'Đã xong', 'Tasks.daydone >= Tasks.deadline'];
            $where_sum_task_chua_xong_dung_tien_dos = ['Tasks.status != "Đã xong"', '"'.date('Y-m-d H:i').'" <= Tasks.deadline'];
            $where_sum_task_chua_xong_cham_tien_dos = ['Tasks.status != "Đã xong"', '"'.date('Y-m-d H:i').'" >= Tasks.deadline'];

            $fromDate = "";
            $toDate = "";
            $team_id = "";
            if ($this->request->is('post')) {
                if ($_POST['fromDate'] != "" && $_POST['toDate'] != "") {
                    $where_task = ['create_at > "'.$_POST['fromDate'].'"', 'create_at < "'.$_POST['toDate'].'"'];
                    $where_sum_task_da_xong_dung_tien_dos = ['Tasks.status' => 'Đã xong', 'Tasks.daydone <= Tasks.deadline', 'create_at > "'.$_POST['fromDate'].'"', 'create_at < "'.$_POST['toDate'].'"'];
                    $where_sum_task_da_xong_cham_tien_dos = ['Tasks.status' => 'Đã xong', 'Tasks.daydone > Tasks.deadline', 'create_at > "'.$_POST['fromDate'].'"', 'create_at < "'.$_POST['toDate'].'"'];
                    $where_sum_task_chua_xong_dung_tien_dos = ['Tasks.status != "Đã xong"', '"'.date('Y-m-d H:i') . '" <= Tasks.deadline', 'create_at > "'.$_POST['fromDate'].'"', 'create_at < "'.$_POST['toDate'].'"'];
                    $where_sum_task_chua_xong_cham_tien_dos = ['Tasks.status != "Đã xong"', '"'.date('Y-m-d H:i') . '" > Tasks.deadline', 'create_at > "'.$_POST['fromDate'].'"', 'create_at < "'.$_POST['toDate'].'"'];
                }
                if ($_POST['fromDate'] != "" && $_POST['toDate'] == "") {
                    $where_task = ['create_at > "'.$_POST['fromDate'].'"', 'create_at < "'.date('Y-m-d H:i').'"'];
                    $where_sum_task_da_xong_dung_tien_dos = ['Tasks.status' => 'Đã xong', 'Tasks.daydone <= Tasks.deadline', 'create_at > "'.$_POST['fromDate'].'"', 'create_at < "'.date('Y-m-d H:i').'"'];
                    $where_sum_task_da_xong_cham_tien_dos = ['Tasks.status' => 'Đã xong', 'Tasks.daydone > Tasks.deadline', 'create_at > "'.$_POST['fromDate'].'"', 'create_at < "'.date('Y-m-d H:i').'"'];
                    $where_sum_task_chua_xong_dung_tien_dos = ['Tasks.status != "Đã xong"', '"'.date('Y-m-d H:i') . '" <= Tasks.deadline', 'create_at > "'.$_POST['fromDate'].'"', 'create_at < "'.date('Y-m-d H:i').'"'];
                    $where_sum_task_chua_xong_cham_tien_dos = ['Tasks.status != "Đã xong"', '"'.date('Y-m-d H:i') . '" > Tasks.deadline', 'create_at > "'.$_POST['fromDate'].'"', 'create_at < "'.date('Y-m-d H:i').'"'];
                }
                if ($_POST['team_id'] != -1) {
                    $where_user = ['Users.team_id' => $_POST['team_id']];
                }
                $fromDate = $_POST['fromDate'];
                $toDate = $_POST['toDate'];
                $team_id = $_POST['team_id'];
            }
            $users = $this->Users->find('all')->contain(['Ratings' => function($q){
                return $q->select(['Ratings.user_id',
                'sum_point' => $this->Ratings->find()->func()->sum('Ratings.point'),
                'count_ratings' => $this->Ratings->find()->func()->count('Ratings.user_id'),
                ])
                ->group('Ratings.user_id');
            }])->where($where_user);
            $tasks = $this->Tasks->find()->select([
                'Tasks.user_action', 
                'sum_task' => $this->Tasks->find()->func()->count('Tasks.id'),
            ])->group('Tasks.user_action')->where($where_task);
            $sum_task_da_xong_dung_tien_dos = $this->Tasks->find()->select(['user_action', 'count'=>$this->Tasks->find()->func()->count('user_action')])->where($where_sum_task_da_xong_dung_tien_dos)->group('Tasks.user_action');
            $sum_task_da_xong_cham_tien_dos = $this->Tasks->find()->select(['user_action', 'count'=>$this->Tasks->find()->func()->count('user_action')])->where($where_sum_task_da_xong_cham_tien_dos)->group('Tasks.user_action');
            $sum_task_chua_xong_dung_tien_dos = $this->Tasks->find()->select(['user_action', 'count'=>$this->Tasks->find()->func()->count('user_action')])->where($where_sum_task_chua_xong_dung_tien_dos)->group('Tasks.user_action');
            $sum_task_chua_xong_cham_tien_dos = $this->Tasks->find()->select(['user_action', 'count'=>$this->Tasks->find()->func()->count('user_action')])->where($where_sum_task_chua_xong_cham_tien_dos)->group('Tasks.user_action');
            $this->set(compact(['teams', 'tasks', 'users','sum_task_da_xong_dung_tien_dos', 'sum_task_da_xong_cham_tien_dos', 'fromDate', 'toDate', 'team_id', 'sum_task_chua_xong_dung_tien_dos', 'sum_task_chua_xong_cham_tien_dos']));
        } else {
            return($this->redirect('/error/error404/'));
        }
    }
}