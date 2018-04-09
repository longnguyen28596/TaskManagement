<?php
use Migrations\AbstractSeed;

/**
 * UserProjects seed.
 */
class UserProjectsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'user_id' => '1',
                'project_id' => '1'
            ],
            [
                'user_id' => '1',
                'project_id' => '2'
            ],
            [
                'user_id' => '2',
                'project_id' => '1'
            ],
            [
                'user_id' => '3',
                'project_id' => '1'
            ],
            [
                'user_id' => '4',
                'project_id' => '2'
            ],
            [
                'user_id' => '5',
                'project_id' => '2'
            ],
            [
                'user_id' => '6',
                'project_id' => '1'
            ],
        ];

        $table = $this->table('user_projects');
        $table->insert($data)->save();
    }
}
