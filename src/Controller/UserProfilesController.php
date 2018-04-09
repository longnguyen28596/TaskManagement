<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class UserProfilesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function edit() {
        if($this->request->is('post')) {
            $UserModel = $this->loadModel('Users');
            $id = $this->current_user->user_profile->id;
            $user_profile = $this->UserProfiles->get($id);
            $this->UserProfiles->patchEntity($user_profile, $this->request->getData());
            if ($this->UserProfiles->save($user_profile)) {
                echo "<script>alert('Cập nhập thông tin thành công')</script>";
                $this->session->write('current_user', $UserModel->writeSession($id));
                return($this->redirect('/UserProfiles/edit'));
            }
        }
        $this->set('current_user',$this->current_user);
    }

    public function add() {
        if($this->request->is('post')) {
            $data = $this->request->getData();
            $data['user_id'] = $this->current_user['id'];
            $user_profile = $this->UserProfiles->newEntity($data);
            if ($this->UserProfiles->save($user_profile)) {
                echo "<script>alert('Cập nhập thông tin thành công')</script>";
                return($this->redirect('/Users/editPasswordForNewUser/'));
            }
        }
    }

    // public function detailUser() {
    //     $user = $this->UserProfiles->find()->where(['user_id' => $_GET['user_id']])->contain(['Users' => function($q){
    //         return $q->where(['Users.status' => '1']);
    //     }])->first();
    //     $this->set('user',$user);
    // }
}
?>