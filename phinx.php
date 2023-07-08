<?php

return
  [
    'paths' => [
      'migrations' => 'db/migrations',
      'seeds' => 'db/seeds'
    ],
    'environments' => [
      'default_migration_table' => 'phinxlog',
      'development' => [
        'adapter' => 'sqlite',
        'name' => 'db/app',
        'suffix' => '.sqlite',
      ]
    ],
    'version_order' => 'creation'
  ];
