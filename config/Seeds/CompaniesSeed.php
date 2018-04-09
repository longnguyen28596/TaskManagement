<?php
use Migrations\AbstractSeed;

/**
 * Companies seed.
 */
class CompaniesSeed extends AbstractSeed
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
                'company_name' => 'Zinza',
                'manager_name' => 'Nguyễn Thành Hải',
                'phone' => '017462517',
                'email' =>  'Hai@gmail.com',
                'address' => 'Toà nhà Hoàng Ngọc',
            ],
            [
                'company_name' => 'Machicon',
                'manager_name' => 'Nguyễn Thị Minh',
                'phone' => '0973426172',
                'email' =>  'Minh@gmail.com',
                'address' => 'Tầng 32 toà nhà Keangnam',
            ],
            [
                'company_name' => 'FPT',
                'manager_name' => 'Nguyễn Trung Dũng',
                'phone' => '017462517',
                'email' =>  'Dung@gmail.com',
                'address' => 'Toà nhà FPT Trần Thái Tông',
            ],
            [
                'company_name' => 'VTC',
                'manager_name' => 'Hoàng Thanh Tùng',
                'phone' => '0917465817',
                'email' =>  'Tung@gmail.com',
                'address' => 'Toà nhà VTC Trần Thái Tông',
            ],
            [
                'company_name' => 'Frame Gia',
                'manager_name' => 'Đỗ Tuấn Anh',
                'phone' => '01827462',
                'email' =>  'TuanAnh@gmail.com',
                'address' => 'Tầng 61 toà nhà keangnam',
            ]

        ];

        $table = $this->table('companies');
        $table->insert($data)->save();
    }
}
