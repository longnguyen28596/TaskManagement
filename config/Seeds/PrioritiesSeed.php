<?php
use Migrations\AbstractSeed;

/**
 * Positions seed.
 */
class PrioritiesSeed extends AbstractSeed
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
                'note' => 'Cao',
            ],
            [
                'note' => 'Trung bình',
            ],
            [
                'note' => 'Thấp',
            ],
        ];

        $table = $this->table('priorities');
        $table->insert($data)->save();
    }
}
