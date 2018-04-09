<?php
use Migrations\AbstractMigration;

class CreateFiles extends AbstractMigration
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
        $table = $this->table('files');
        $table->addColumn('task_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('create_at', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
        ]);
        $table->create();
    }
}
