<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;
use Cake\I18n\Time;

class ProjectTeamsController extends AppController
{
    public $paginate = [
        'limit' => 10
    ];

    public function index() {
        
    }

    public function listProjectManager() {
        $projects = $this->ProjectTeams->getListProjectsManager($this->current_user['id'], $this->current_user['team_id'])->toArray();
        $this->set(compact(['projects']));
    }
}
?>