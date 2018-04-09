<?php
use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('username', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('password', 'string', [
            'default' => sha1('12345678'),
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('position_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('last_login', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('status', 'boolean', [
            'default' => '1',
            'null' => false,
        ]);
        


        $table->addColumn('name', 'string', [
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('email', 'string', [
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('id_card', 'string', [
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('birthday', 'date', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('sex', 'boolean', [
            'null' => true,
        ]);
        $table->addColumn('phone', 'string', [
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('address', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('avatar', 'text', [
            'null' => true,
        ]);



        $table->addColumn('create_at', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true
        ]);
        $table->create();
    }
}
