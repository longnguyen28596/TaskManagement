<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class MessagesController extends AppController
{
    function edit(){
        $messages = $this->Messages->find()->where(['user_id' => $this->current_user['id'], 'checked' => '0']);
        if($messages != []) {
            foreach($messages as $message) {
                $message->checked = '1';
                $this->Messages->save($message);
            }
        }
        die();
    }
}
?>