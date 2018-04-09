<?php
use Migrations\AbstractMigration;

class CreateCompanies extends AbstractMigration
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
        $table = $this->table('companies');
        $table->addColumn('company_name', 'string', [
            'default' => null,
            'limit' => 255,
        ]);
        $table->addColumn('manager_name', 'string', [
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('phone', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('email', 'string', [
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('address', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('status', 'boolean', [
            'default' => '1',
            'null' => false,
        ]);
        $table->addColumn('create_at', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
