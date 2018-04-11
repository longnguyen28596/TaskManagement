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
    public $usersModel; 
    public $userProjectsModel;
    public $companiesModel;
    public $teamsModel;
    public $projectsModel;
    public $positionModel;
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->usersModel = $this->loadModel('Users');
        $this->userProjectsModel = $this->loadModel('UserProjects');
        $this->teamsModel = $this->loadModel('Teams');
        $this->companiesModel = $this->loadModel('Companies');
        $this->projectsModel = $this->loadModel('Projects');
        $this->positionModel = $this->loadModel('Positions');
        if ($this->request->here != '/Users/login' && !$this->request->session()->read('current_user')) {
            return($this->redirect('/Users/login'));
        }
        if ($this->request->here == '/Users/login' && $this->request->session()->read('current_user')) {
            return($this->redirect('/'));
        }
        $this->session = $this->request->session();
        if ($this->session->read('current_user') != NULL) {
            $this->current_user = $this->session->read('current_user');
        }
    }

    public function beforeFilter(Event $event)
    {
    }
}
