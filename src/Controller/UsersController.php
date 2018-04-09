<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;
use Cake\I18n\Time;

class UsersController extends AppController
{
    public $paginate = [
        'limit' => 10
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
                $listProjectManager = $this->projectsModel->getListProjectsManager($user['id'])->toArray();
                $this->session->write('current_user', $this->usersModel->writeSession($user['id']));
                $this->session->write('listProjectManager', $listProjectManager);
                if ($user->last_login) {
                    return($this->redirect('/'));
                } else {
                    return($this->redirect('/Users/edit/'.$user['id']));
                }
            }
        }
    }

    public function add() {
        $positions = $this->positionModel->getAll();
        $teams = $this->teamsModel->getAll();
        if ($this->request->is('post')) {
            $user = $this->Users->newEntity($this->request->getData());
            if($this->Users->save($user)) {
                echo "<script>alert('Them thành công')</script>";
            }
        }
        $this->set(compact(['teams', 'positions']));
    }

    // id: User ID
    public function edit($id) {
        $user = $this->Users->get($id);
        if ($this->request->is('post')) {
            $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                echo "<script>alert('Cập nhập thông tin thành công')</script>";
                $this->session->write('current_user', $this->Users->writeSession($id));
                if ($this->current_user['last_login'])
                    return($this->redirect('/Users/edit/'.$user['id']));
                else {
                    return($this->redirect('/Users/editPasswordForNewUser/'));
                }
            }
        }
        $this->set(compact(['user']));
    }

    public function view($id) {
        $user = $this->Users->get($id);
        $this->set('user',$user);
    }

    public function delete($id) {
        $user = $this->Users->get($id);
        if ($user) {
            $user->status = '0';
            if ($this->Users->save($user)) {
                echo "<script>alert('Xoa thanh cong')</script>";
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
                echo "<script>alert('Sửa mật khẩu thành công')</script>";
                $user = $this->Users->get($id);
                $user->password = $_POST['new_password'];
                $this->Users->save($user);
            }
        }
        $this->set(compact(['current_user']));
    }

    public function editPassword($id) {
        $current_user = $this->request->session()->read('current_user');
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
                echo "<script>alert('Sửa mật khẩu thành công')</script>";
                $user = $this->Users->get($id);
                $user->password = $_POST['new_password'];
                $this->Users->save($user);
            }
        }
        $this->set(compact(['current_user']));
    }

    public function logout() {
        $user = $this->Users->get($this->current_user['id']);
        $user->last_login = Time::now();
        session_destroy();

        return($this->redirect('/Users/login'));
    }

}
