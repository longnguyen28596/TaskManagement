<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;
use Cake\I18n\Time;

class CommentsController extends AppController
{
    // $task_id 
    public function add($task_id) {
        if ($this->request->is('post')) {
            $comment = [
                'task_id' => $task_id,
                'user_id' => $this->current_user['id'],
                'content' => $_POST['content_comment'],
                'parent' => isset($_POST['comment_parent']) ? $_POST['comment_parent'] : '0'
            ];
            $comment = $this->Comments->newEntity($comment);
            if ($this->Comments->save($comment)) {
                $comment = $this->Comments->save($comment);
                $this->redirect('/Tasks/view/'.$comment->task_id.'/#'.$comment->id);
            }
        }
    }

    // id
    public function delete($id) {
        $comment = $this->Comments->get($id);
        if ($comment->parent == 0) {
            $comment_childs = $this->Comments->find()->where(['parent' => $comment->id]);
            if ($comment_childs) {
                foreach ($comment_childs as $comment_child) {
                    $this->Comments->delete($comment_child);
                }
            }
        }
        $this->Comments->delete($comment);
        die();
    }

    public function edit($id) {
        if ($this->request->is('post')) {
            $comment = $this->Comments->get($id);
            $comment->content = $_POST['content_comment'];
            if ($this->Comments->save($comment)) {
                $comment = $this->Comments->save($comment);
                $this->redirect('/Tasks/view/'.$comment->task_id.'/#'.$comment->id);
            }
        }
    }
}
?>
