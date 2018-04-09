<?php
use Migrations\AbstractMigration;

class RemoveUserIdFromTeams extends AbstractMigration
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
        $table->removeColumn('user_id')
              ->save();
    }
}
