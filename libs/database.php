<?php 

namespace Libs;

use \Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
  public function __construct() {
    $capsule = new Capsule();
    $capsule->addConnection([
      'driver' => env('DB_DRIVER'),
      'host' => env('DB_HOST'),
      'port' => env('DB_PORT'),
      'database' => env('DB_DATABASE'),
      'username' => env('DB_USERNAME'),
      'password' => env('DB_ PASS'),
      'charset' => 'utf8',
      'collation ' => 'utf8_unicode_ci',
      'prefix' => ''
    ]);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
  }
}
