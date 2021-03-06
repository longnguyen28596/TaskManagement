<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;
use Cake\I18n\Time;

class UsersController extends AppController
{
    public $paginate = [
        'limit' => 20
    ];

    public function index() {
        $users = $this->Users->getAll();
        $this->set('users', $this->paginate($users));
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Users->checklogin($_POST['username'], $_POST['password']);
            if ($user) {
                $this->Flash->success("Bạn đã đăng nhập thành công.");
                $this->session->write('current_user', $this->Users->writeSession($user['id']));
                if ($user->last_login) {
                    return($this->redirect('/'));
                } else {
                    return($this->redirect('/Users/edit/'.$user['id']));
                }
            }
        }
    }

    public function resetPassword(){
        if ($this->request->is('post')) {
            $user = $this->Users->find()->where(['email' => $_POST['email']])->first();
            if ($user) {
                $token = bin2hex(random_bytes(78));
                if ($this->Emails->addNew($user->id, $token, 'reset password')) {
                    return($this->redirect('/Users/login'));
                }
            }
        }
        if (isset($_GET['token'])) {
            $email = $this->Emails->find()->where(['variable' => $_GET['token']])->first();
            if ($email) {
                $user = $this->Users->get($email->user_id);
                $user->password = '12345678';
                if ($this->Users->save($user)) {
                    $this->Flash->success("Password của bạn đã được rest về giá trị mặc định.");
                }
            }
        }
    }

    public function add() {
    if ($this->current_user['position_id'] == 1 || $this->current_user['position_id'] == 2) {
        $positions = $this->Positions->getAll();
        $teams = $this->Teams->getAll();
        if ($this->request->is('post')) {
            $check_user = $this->Users->find()->where(['username' => $_POST['username']])->count();
            if ($check_user != 0) {
                $this->Flash->error("Đã tồn tại tên đăng nhập này.");
                return($this->redirect('/Users/add/'));
            }
            $user = $this->Users->newEntity($this->request->getData());
            if($this->Users->save($user)) {
                $this->Flash->success("Thêm mới người dùng thành công.");
                return($this->redirect('/Users/index/'));
            }
        }
        $this->set(compact(['teams', 'positions']));
    } else {
        return($this->redirect('/error/error404/'));
    }
    }

    // id: User ID
    public function edit($id) {
        if ($this->current_user['position_id'] == 1 || $this->current_user['position_id'] == 2 || $this->current_user['id'] == $id ) {
            $user = $this->Users->get($id);
            if ($this->request->is('post')) {
                $this->Users->patchEntity($user, $this->request->getData());
                $user = $this->Users->save($user);
                if ($user) {
                    if (isset($_FILES['avatar'])){
                        $type = pathinfo($_FILES['avatar']['tmp_name'], PATHINFO_EXTENSION);
                        $data = file_get_contents($_FILES['avatar']['tmp_name']);
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                        $user->avatar = $base64;
                        $this->Users->save($user);
                    }
                    $this->session->write('current_user', $this->Users->writeSession($id));
                    if ($this->current_user['last_login'])
                        return($this->redirect('/Users/edit/'.$user['id']));
                    else {
                        return($this->redirect('/Users/editPasswordForNewUser/'));
                    }
                }
            }
            $this->set(compact(['user']));
        } else {
            return($this->redirect('/error/error404/'));
        }
    }

    public function editByAdmin($id) {
        if ($this->current_user['position_id'] == 1 || $this->current_user['position_id'] == 2) {
            $user = $this->Users->get($id);
            if ($this->request->is('post')) {
                $this->Users->patchEntity($user, $this->request->getData());
                $user = $this->Users->save($user);
                if ($user) {
                    if (isset($_FILES['avatar'])){
                        $type = pathinfo($_FILES['avatar']['tmp_name'], PATHINFO_EXTENSION);
                        $data = file_get_contents($_FILES['avatar']['tmp_name']);
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                        $user->avatar = $base64;
                        $this->Users->save($user);
                    }
                    return($this->redirect('/Users/index/'));
                }
            }
            $this->set(compact(['user']));
        } else {
            return($this->redirect('/error/error404/'));
        }
    }

    public function view($id) {
        $user = $this->Users->get($id);
        $project_of_users = $this->UserProjects->find()->where(['user_id' => $id, 'deleted' => '0'])->contain(['Projects']);
        $all_project_of_users = $this->UserProjects->find()->where(['user_id' => $id])->contain(['Projects']);
        $all_tasks_of_users = $this->Tasks->find('all')->where(['user_action' => $id]);
        $all_rating_of_users = $this->Ratings->find('all')->where(['user_id' => $id]); 
        $this->set('user', $user);
        $this->set('project_of_users', $project_of_users);
        $this->set('all_project_of_users', $all_project_of_users);
        $this->set('all_tasks_of_users', $all_tasks_of_users);
        $this->set('all_rating_of_users', $all_rating_of_users);


    }

    public function delete($id) {
        $user = $this->Users->get($id);
        if ($user) {
            $user->status = '0';
            if ($this->Users->save($user)) {
                $this->Flash->success("Xoá thành công.");
            }
        }
        return($this->redirect('/Users/index'));
    }

    public function editPasswordForNewUser() {
        $current_user = $this->current_user;
        $id = $current_user->id;
        if (isset($_GET['ajax_current_password']) && $_GET['ajax_current_password']) {
            if (sha1($_GET['ajax_current_password']) == $current_user['password']) {
                 echo "<script>document.getElementById('noidung').style.display = 'none';</script>";
            } else {
                echo "<script>document.getElementById('noidung').style.display = 'block';</script>";
            }
        }
        if ($this->request->is('post')) {
            if ($this->Users->changePassword($current_user['id'], $_POST['new_password'])) {
                $this->Flash->success("Cập nhập thành công.");
                $user = $this->Users->get($id);
                $user->password = $_POST['new_password'];
                $this->Users->save($user);
            }
        }
        $this->set(compact(['current_user']));
    }

    public function editPassword($id) {
        if ($this->current_user['position_id'] == 1 || $this->current_user['position_id'] == 2 || $this->current_user['id'] == $id ) {
            $current_user = $this->current_user;
            $id = $current_user->id;
            if (isset($_GET['ajax_current_password']) && $_GET['ajax_current_password']) {
                if (sha1($_GET['ajax_current_password']) == $current_user['password']) {
                    echo "<script>document.getElementById('noidung').style.display = 'none';</script>";
                } else {
                    echo "<script>document.getElementById('noidung').style.display = 'block';</script>";
                }
            }
            if ($this->request->is('post')) {
                if ($this->Users->changePassword($current_user['id'], $_POST['new_password'])) {
                    $this->Flash->success("Cập nhập thành công.");
                    $user = $this->Users->get($id);
                    $user->password = $_POST['new_password'];
                    $this->Users->save($user);
                }
            }
            $this->set(compact(['current_user']));
        } else {
            return($this->redirect('/error/error404/'));
        }
    }

    public function logout() {
        $user = $this->Users->get($this->current_user['id']);
        $user->last_login = Time::now();
        $this->Users->save($user);
        session_destroy();
        $this->Flash->success("Bạn đã đăng xuất thành công.");
        return($this->redirect('/Users/login'));
    }

    public function changeTeam($user_id) {
        if ($this->current_user['position_id'] == 1 || $this->current_user['position_id'] == 2 ) {
            $teams = $this->Teams->getAll();
            $user = $this->Users->get($user_id);
            $positions = $this->Positions->getAll();
            if ($this->request->is('post')) {
                if ($_POST['position_id'] == 5) {
                    $team_new = $this->Teams->get($_POST['team_id']);
                    $team_new->leader = $user_id;
                    $this->Teams->save($team_new);
                }
                $user->position_id = $_POST['position_id'];
                $user->team_id = $_POST['team_id'];
                if ($this->Users->save($user)) {
                    $this->Flash->Success('Đã cập nhật thành công cho ' . $user['name']);
                }
            }
            $this->set(compact(['teams', 'user', 'positions']));
        } else {
            return($this->redirect('/error/error404/'));
        }
    }
}
