<?php

return
  [
    'paths' => [
      'migrations' => 'db/migrations',
      'seeds' => 'db/seeds'
    ],
    'environments' => [
      'default_migration_table' => 'phinxlog',
      'default_environment' => 'production',
      'production' => [
        'adapter' => 'mysql',
        'name' => 'todo_list_app',
        'host' => 'localhost',
        'user' => 'root',
        'pass' => 'root',
        'port' => 3306,
        'charset' => 'utf8',
      ]
    ],
    'version_order' => 'creation'
  ];
