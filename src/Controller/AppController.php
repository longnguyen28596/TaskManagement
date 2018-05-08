<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Network\Session\DatabaseSession;
use App\View\Helper\ApplicationHelper;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public $session;
    public $current_user;
    public $AppHelper;
    public function initialize()
    {
        parent::initialize();
        $this->session = $this->request->session();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadModel('Users');
        $this->loadModel('UserProjects');
        $this->loadModel('Teams');
        $this->loadModel('Companies');
        $this->loadModel('Projects');
        $this->loadModel('Positions');
        $this->loadModel('Images');
        $this->loadModel('Emails');
        $this->loadModel('Comments');
        $this->loadModel('ProjectTeams');
        $this->loadModel('Ratings');
        $this->loadModel('Messages');
        $this->loadModel('Tasks');
        $this->AppHelper = new ApplicationHelper(new \Cake\View\View());        
        if ($this->request->here != '/Users/login' && $this->request->here != '/Users/resetPassword'  && !$this->request->session()->read('current_user')) {
            return($this->redirect('/Users/login'));
        }
        if ($this->request->here == '/Users/login' && $this->request->session()->read('current_user')) {
            return($this->redirect('/'));
        }
        if ($this->session->check('current_user')) {
            $this->current_user = $this->session->read('current_user');
        }

    }

    public function beforeFilter(Event $event)
    {
        if ($this->request->session()->check('current_user')) {
            $countProjectManager = $this->ProjectTeams->getCountProjectsManager($this->current_user['id'], $this->current_user['team_id']);
            $myProjects = $this->UserProjects->getProjectByUser($this->current_user['id']);
            $count_messages = $this->Messages->getCountMessagesDoNotCheck($this->current_user['id']);
            $mesages = $this->Messages->getListMessagesLimit($this->current_user['id']);
            $this->set(compact(['countProjectManager', 'myProjects', 'count_messages', 'mesages']));
        }
    }
}
