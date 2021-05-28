<?php

use Dotenv\Dotenv;
use Libs\Core;

require_once '../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
$core = new Core();
