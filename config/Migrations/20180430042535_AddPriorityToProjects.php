<?php
use Migrations\AbstractMigration;

class AddPriorityToProjects extends AbstractMigration
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
        $table = $this->table('projects');
        $table->addColumn('priority', 'string', [
            'default' => 'Trung bình',
            'limit' => 255,
        ]);
        $table->addColumn('time_release', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->update();
    }
}
