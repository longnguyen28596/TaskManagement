<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UserProjectsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->belongsTo('Users');
        $this->belongsTo('Projects');
    }

    // lấy tất cả user tham gia dự án(đã từng( có thể cả nghỉ việc rồi), hoặc đang tham gia cũng hiển thị)
    public function getAllUserProjectByProjectId($project_id) {
        return $this->find('all')->where(['project_id' => $project_id])->contain(['Users', 'Projects']);
        // return $this->find('all')->where(['project_id' => $project_id])->contain(['Users', 
        // 'Projects' => function($q) use ($project_id){
        //     return $q->where(['Projects.id' => $project_id]);
        // }]);
    }

    public function getUserProjectByProjectId($project_id) {
        return $this->find('all')->where(['project_id' => $project_id])->contain(['Users',
        'Projects' => function($q) use ($project_id){
            return $q->where(['Projects.id' => $project_id]);
        }]);
    }
    
    public function getUserProjectByProjectId2($project_id, $team_id) {
        return $this->find('all')->where(['project_id' => $project_id])->contain([
        'Users' => function($q) use($team_id){
            return $q->where(['Users.team_id' => $team_id]);
        },
        'Projects' => function($q) use ($project_id){
            return $q->where(['Projects.id' => $project_id]);
        }]);
    }

    public function addNew($user_id, $project_id) {
        $data = [
            'user_id' => $user_id,
            'project_id' => $project_id,
        ]; 
        $data = $this->newEntity($data);
        $this->save($data);
    }

    public function getProjectByUser($user_id) {
        return $this->find('all')->select('UserProjects.id')->where(['UserProjects.user_id' => $user_id])->contain(['Projects' => function($q){
            return $q->select(['id', 'name'])
                    ->where(['Projects.status' => '0']);
        }]);
    }
}