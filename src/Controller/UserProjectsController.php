<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;
use Cake\I18n\Time;

class UserProjectsController extends AppController
{
    public $paginate = [
        'limit' => 10
    ];
}
?>