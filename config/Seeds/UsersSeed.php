<?php
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
                'username' => 'userdemo1',
                'team_id' =>'1',
                'position_id' => '1',
                'last_login' => NULL, 
                'name' => 'Nguyễn Văn An',
                'email' => 'anvan@gmail.com',
                'id_card' => '027635216',
                'birthday' => '1970/2/3',
                'sex' => '1',
                'phone' => '098756543',
                'address' => 'Đống Đa, Hà Nội',
            ],
            [
                'username' => 'userdemo2',
                'position_id' => '2',
                'last_login' => NULL, 
                'team_id' => '2',
                'name' => 'Phạm Văn Thành',
                'email' => 'phamvanthanh@gmail.com',
                'id_card' => '0873526123',
                'birthday' => '1980/1/3',
                'sex' => '1',
                'phone' => '0987654376',
                'address' => 'Thanh Xuân, Hà Nội',
            ],
            [
                'username' => 'userdemo3',
                'position_id' => '2',
                'last_login' => NULL, 
                'team_id' => '2',
                'name' => 'Trần Bình Trọng',
                'email' => 'trong@gmail.com',
                'id_card' => '012978531571',
                'birthday' => '1991/5/1',
                'sex' => '1',
                'phone' => '098746143',
                'address' => 'Cầu Giấy, Hà Nội',
            ],
            [
                'username' => 'userdemo4',
                'position_id' => '3',
                'last_login' => NULL,
                'team_id' => '2',
                'name' => 'Phạm Hữu Nghĩa',
                'email' => 'nghia@gmail.com',
                'id_card' => '0198751351273',
                'birthday' => '1992/6/9',
                'sex' => '1',
                'phone' => '0987816421',
                'address' => 'Ngã Tư Sở, Hà Nội',
            ],
            [
                'username' => 'userdemo5',
                'position_id' => '3',
                'last_login' => NULL, 
                'team_id' => '3',
                'name' => 'Bùi Mạnh Quân',
                'email' => 'quan@gmail.com',
                'id_card' => '013260381',
                'birthday' => '1995/1/7',
                'sex' => '1',
                'phone' => '098761542',
                'address' => 'Thái Hà, Hà Nội',
            ],
            [
                'username' => 'userdemo6',
                'position_id' => '3',
                'last_login' => NULL, 
                'team_id' => '3',
                'name' => 'Nguyễn Thị Minh',
                'email' => 'Minh@gmail.com',
                'id_card' => '01197531432',
                'birthday' => '1995/9/8',
                'sex' => '0',
                'phone' => '0987644132',
                'address' => 'Thanh Xuân, Hà Nội',
            ],
            [
                'username' => 'userdemo7',
                'position_id' => '4',
                'last_login' => NULL,
                'team_id' => '1',
                'name' => 'Nguyễn Hoàn Long',
                'email' => 'longnguyen28596@gmail.com',
                'id_card' => '013260689',
                'birthday' => '1996/5/28',
                'sex' => '1',
                'phone' => '01655538996',
                'address' => 'Cầu Giấy, Hà Nội',
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
