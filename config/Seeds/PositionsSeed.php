<?php
use Migrations\AbstractSeed;

/**
 * Positions seed.
 */
class PositionsSeed extends AbstractSeed
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
                'name' => 'Giám đốc',
            ],
            [
                'name' => 'Phó giám đốc',
            ],
            [
                'name' => 'Nhân viên',
            ],
            [
                'name' => 'Thực tập',
            ],
        ];

        $table = $this->table('positions');
        $table->insert($data)->save();
    }
}
