<?php
use Migrations\AbstractMigration;

class AddStatusToPositions extends AbstractMigration
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
        $table = $this->table('positions');
        $table->addColumn('status', 'boolean', [
            'default' => 1,
        ]);
        $table->update();
    }
}
