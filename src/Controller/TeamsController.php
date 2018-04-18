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
        $users = $this->usersModel->find('all')->contain(['UserProfiles','Positions']);
        if ($this->request->is('post')) {
            $team = $this->Teams->newEntity($this->request->getData());
            if ($this->Teams->save($team)) {
                return($this->Flash->success("Tạo mới team thành công."));
            } else {
                $this->Flash->success("Tạo mới team thất bại.");
            }
        }
        $this->set(compact('users'));
    }

    public function usersOfTeam($team_id) {
        $team = $this->Teams->get($team_id);
        $userProjects = $this->userProjectsModel->getAllUserProjectByProjectId($id);
        $this->set(compact('team', 'users'));
    }
}
?>

