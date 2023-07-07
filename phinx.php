<?php

return
  [
    'paths' => [
      'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
      'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
      'default_migration_table' => 'phinxlog',
      'default_environment' => 'development',
      'development' => [
        'adapter' => 'sqlite',
        'name' => 'db/app',
        'suffix' => '.sqlite',
      ]
    ],
    'version_order' => 'creation'
  ];
