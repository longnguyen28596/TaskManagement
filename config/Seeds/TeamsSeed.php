<?php
use Migrations\AbstractSeed;

/**
 * Teams seed.
 */
class TeamsSeed extends AbstractSeed
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
                'name' => 'Android',
                'leader' => '1'
            ],
            [
                'name' => 'Web PHP',
                'leader' => '4'
            ],
            [
                'name' => 'Web Ruby on Rails',
                'leader' => '3'
            ],
            [
                'name' => 'Game Unity',
                'leader' => '2'
            ],
        ];

        $table = $this->table('teams');
        $table->insert($data)->save();
    }
}
