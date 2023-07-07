<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTasksTable extends AbstractMigration
{
  public function up(): void
  {
    // Phinx create a primary key id auto increment
    $table = $this->table('tasks');
    $table
      ->addColumn('created_at', 'datetime')
      ->addColumn('updated_at', 'datetime')
      ->addColumn('task', 'string', ['limit' => 255])
      ->addColumn('status', 'string', ['default' => 'pending'])
      ->create();
  }

  public function down(): void
  {
    $this->table('tasks')->drop()->save();
  }
}
