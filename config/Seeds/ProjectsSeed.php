<?php
use Migrations\AbstractSeed;

/**
 * Projects seed.
 */
class ProjectsSeed extends AbstractSeed
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
                'name' => 'Linkball',
                'company_id' => '1',
                'team_id' => '1',
                'status' => 0,
            ],
            [
                'name' => 'GLO',
                'company_id' => '2',
                'team_id' => '2',
                'status' => 0,
            ],
        ];

        $table = $this->table('projects');
        $table->insert($data)->save();
    }
}
