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
            $task = $this->Tasks->get($task_id);
            $comment = $this->Comments->newEntity($comment);
            if ($this->Comments->save($comment)) {
                $this->Flash->success("Bạn đã thêm bình luận mới.");
                $comment = $this->Comments->save($comment);
                if (isset($_POST['comment_parent']) && $_POST['comment_parent'] != '0') {
                    $comment_parent = $this->Comments->get($_POST['comment_parent']);
                    $this->Messages->addNew($comment_parent['user_id'], $this->current_user['name'] . ' đã trả lời bình luận của bạn', '/Tasks/view/'.$comment->task_id.'/#'.$comment->id);
                } else {
                    $this->Messages->addNew($task['user_action'], $this->current_user['name'] . 'đã thêm 1 bình luân mới', '/Tasks/view/'.$comment->task_id.'/#'.$comment->id);
                    $this->Messages->addNew($task['user_request'], $this->current_user['name'] . 'đã thêm 1 bình luân mới', '/Tasks/view/'.$comment->task_id.'/#'.$comment->id);
                }
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
                $this->Flash->success("Tạo mới team thành công.");            
            }
        }
    }
}
?>
