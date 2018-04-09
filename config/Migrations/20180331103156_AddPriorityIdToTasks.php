<?php
use Migrations\AbstractMigration;

class AddPriorityIdToTasks extends AbstractMigration
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
        $table = $this->table('tasks');
        $table->addColumn('priority_id', 'integer', [
            'default' => '2',
            'limit' => 11,
        ]);
        $table->update();
    }
}
