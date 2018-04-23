<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class PositionsController extends AppController
{
    public function index(){
        $positions = $this->Positions->find('All')->where(['status' => '1']);
        $this->set('positions',$positions);
    }
    
    public function add(){
        if(($this->request->is('get') && isset($_GET['new_name_position']))) {
            $check_name = $this->Positions->find()->where(['name like' =>'%'.$_GET['new_name_position'].'%'])->count();
            if ($check_name != 0) {
                echo 'false';
                die();
            }
        }
        if ($this->request->is('post')) {
            $check_name = $this->Positions->find()->where(['name' =>'%'.$_POST['name'].'%'])->count();
            if ($check_name == 0) {
                $user = $this->Positions->newEntity($this->request->getData());
                if ($this->Positions->save($user)) {
                    return($this->redirect('/Positions/add'));
                }
            } else {
                echo "<script>alert('Tên chức vụ này đã có')</script>";
            }
        }
    }

    public function edit($id) {
        $position = $this->Positions->find()->where(['id' => $id, 'status' => '1'])->first();
        if ($this->request->is('post')) {
            $position->name = $_POST['name'];
            if ($this->Positions->save($position)) {
                echo "<script>alert('Cập nhập thành công')<script>";
                return($this->redirect('/Positions/edit/'.$id));
            }
        }
        $this->set('position',$position);
    }

    public function delete($id) {
        $position = $this->Positions->find()->where(['id' => $id, 'status' => '1'])->first();
        $position->status = '0';
        if ($this->Positions->save($position)) {
            echo "<script>alert('Xoá thành công')<script>";
        }
        return($this->redirect('/Positions/index/'));
        $this->set('position',$position);
    }

    public function listUsersByPosition($id) {
        $users = $this->Users->getListUsersByPosition($id);
        $this->set('users',$this->paginate($users));
    }
}
?>
