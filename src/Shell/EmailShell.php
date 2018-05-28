<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\I18n\Time;

class EmailShell extends Shell
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Emails');
    }

    public function main()
    {
        $count = $this->Emails->find()->where(['Emails.sended_at is' => Null])->count();
        if ($count > 0) {
            $emails = $this->Emails->find()->where(['Emails.sended_at is' => Null])->contain(['users' => function($q){
                return $q->select(['name', 'email'])
                        ->where(['Users.status' => '1']);
            }]);
            $variable = array();
            foreach ($emails as $item) {
                switch ($item->type) {
                    case 'reset password':
                        $type_form = 'resetPassword';
                        $variable = ['username' => $item->Users['name'],'token' => $item->variable];
                        break;
                    case 'new task':
                        $type_form = 'newTask';
                        $variable = ['username' => $item->Users['name'],'task_id' => $item->variable];
                        break;
                    case 'edit task':
                        $type_form = 'editTask';
                        $variable = ['username' => $item->Users['name'],'task_id' => $item->variable];
                        break;
                    default:
                        break;
                }
                $email = new Email();
                $email
                ->template($type_form)
                ->emailFormat('html')
                ->subject('Thông báo từ hệ thống Taskmanagement.com')
                ->to($item->Users['email'])
                ->viewVars($variable)
                ->from('taskmanagement28596@gmail.com')
                ->send();

                if ($email) {
                    $item->sended_at = Time::now();
                    $this->Emails->save($item);
                }
            }
        }
    }
}
