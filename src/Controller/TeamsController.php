<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;

class TeamsController extends AppController
{
    public function index() {
        $teams = $this->Teams->getAll();
        $this->set(compact('teams'));
    }

    public function add() {
        if ($this->current_user['position_id'] == 1 || $this->current_user['position_id'] == 2) {        
            $users = $this->Users->find('all')->contain(['Positions']);
            if ($this->request->is('post')) {
                $team = $this->Teams->newEntity($this->request->getData());
                if ($this->Teams->save($team)) {
                    $user = $this->Users->get($_POST['leader']);
                    $user->team_id = $team->id;
                    $this->Users->save($user);
                    $this->Flash->success("Tạo mới team thành công.");
                    return($this->redirect('/Teams/index'));
                } else {
                    $this->Flash->error("Tạo mới team thất bại.");
                }
            }

        $this->set(compact('users'));
        } else {
            return($this->redirect('/error/error404/'));
        }
    }

    public function usersOfTeam($team_id) {
        $team = $this->Teams->get($team_id);
        $users = $this->Users->getListUserByTeam($team->id, $contain=['Positions']);
        $this->set(compact('team', 'users'));
    }
}
?>

