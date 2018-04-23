<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CommentsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->belongsTo('Users');
        $this->belongsTo('Tasks');
    }

    public function getCommentByTaskID($task_id) {
        return $this->find('all')->where(['Comments.task_id' => $task_id])->contain(['Users' => function($q){
            return $q->select(['id','name', 'username', 'avatar']);
        }]);
    }

    public function addNew($task_id, $current_user, $parent, $content) {
            $comment = [
                'task_id' => $task_id,
                'user_id' => $user_id,
                'parent' => $parent,
                'content' => $content
            ];
            $comment = $this->newEntity($comment);
            if ($this->save($comment)) {
                $comment = $this->save($comment);
                return '
                <div style="border: 0.05rem solid #a9afbb; margin-bottom: 10px"></div>
                <div class="row">
                    <div class="col-sm-1 col-md-1">
                        <a target="_blank" href="/Users/view/'.$user_id.'">
                            <img class="img" src="'.$current_user['avatar'].'"/>
                        </a>
                    </div>
                    <div class="col-sm-11 col-md-11">
                        <p>
                            <a target="_blank" href="/Users/view/'.$current_user['username'].'">
                            '.$current_user['username'].'
                            </a><span style="color: silver; font-size: 13px; font-style: italic">đã bình luận lúc '.$this->AppHelper->fullDateTime($comment->created).'</span>
                        </p>
                        <div style="font-size: 15px;font-weight: 300;">'.$comment->content.'</div>
                    </div>
                </div>';
            }
    }
}
