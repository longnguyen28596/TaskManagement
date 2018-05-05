<?php
use Migrations\AbstractMigration;

class CreateRatings extends AbstractMigration
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
        $table = $this->table('ratings');
        $table->addColumn('task_id', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('user_id', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('point', 'float', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
