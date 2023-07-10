<?php

require 'vendor/autoload.php';

use App\Server;
use \Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);

$dotenv->load();

$server = new Server();

$server->start();
