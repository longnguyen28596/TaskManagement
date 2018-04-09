<?php
use Migrations\AbstractMigration;

class AddCriteriaToTeams extends AbstractMigration
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
        $table = $this->table('teams');
        $table->addColumn('criteria', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->update();
    }
}
