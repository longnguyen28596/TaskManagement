<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;

/**
 * Users Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Roles
 * @property |\Cake\ORM\Association\BelongsTo $Positions
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->belongsTo('Positions');
        $this->belongsTo('Teams');
        $this->hasMany('UserProjects');
        $this->hasMany('Tasks');
        $this->hasMany('Emails');        
    }

    public function findAuth(\Cake\ORM\Query $query, array $options)
    {
        $query
            ->where(['Users.status' => 1]);
    
        return $query;
    }

    public function updateLastLogin($id) {
        // $user = $this->Users->newEntity($data);
        $user = $this->get($id);
        $time = Time::now();
        if ($user) {
            $user->last_login = $time;
            $this->save($user);
        } else {

            return;
        }
    }

    public function checklogin($username, $password) {
        return $this->find()->where(['username' => $username, 'password' => sha1($password)])->contain(['Positions'])->first();
    }

    public function changePassword($id, $new_password) {
        $user = $this->get($id);
        $user->password = $new_password;

        return $this->save($user);
    }

    public function writeSession($id) {
        return $this->find()->where(['Users.id' => $id, 'Users.status' => '1'])->contain(['Positions'])->first();
    }

    public function getListUsersByPosition($id) {
        return $this->find()->where(['Users.status' => '1', 'Users.position_id' => $id])->contain(['Positions']);
    }

    public function getListUserByTeam($team_id, $contain) {
        if ($contain != '') {
            return $this->find('all')->where(['Users.status' => '1', 'Users.team_id' => $team_id])->contain($contain);
        } else {
            return $this->find('all')->where(['Users.status' => '1', 'Users.team_id' => $team_id]);
        }
    }

    public function getAll() {
        return $this->find('all')->where(['Users.status' => '1'])->contain(['Positions']);
    }
}
