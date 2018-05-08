<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Network\Session;

class MessagesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->belongsTo('Users');
    }

    public function addNew($user_id, $content, $url) {
        $session = new Session();
        if ($session->read()['current_user']->id != $user_id) {
            $message = [
                'user_id' => $user_id,
                'content' => $content,
                'url' => $url,
            ];
            $message = $this->newEntity($message);
            return $this->save($message);
        }
    }

    public function getCountMessagesDoNotCheck($user_id) {
       return $this->find('all')->order([ 'id' => 'desc'])->where(['user_id' => $user_id, 'checked' => '0'])->count();
    }

    public function getListMessagesLimit($user_id) {
        return $this->find('all')->order([ 'id' => 'desc'])->where(['user_id' => $user_id])->limit('8');
    }
}
