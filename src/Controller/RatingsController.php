<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class RatingsController extends AppController
{
    public function add(){
        $rating = [
            'point' => $_POST['point'],
            'task_id' => $_POST['id_task'],
            'user_id' => $_POST['user_id'],
        ];
        $rating = $this->Ratings->newEntity($rating);
        $this->Ratings->save($rating);
        die();
    }

    public function delete(){
        $rating = $this->Ratings->find()->where(['task_id' => $_POST['id_task'], 'user_id' => $_POST['user_id']])->first();
        $this->Ratings->delete($rating);
        die();
    }
}
?>