<?php
use Migrations\AbstractMigration;

class CreatePriorities extends AbstractMigration
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
        $table = $this->table('priorities');
        $table->addColumn('note', 'string', [
            'limit' => 255,
        ]);
        $table->create();
    }
}
