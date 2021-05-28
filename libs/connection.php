<?php 

namespace Libs;

class Connection {
  private $host;
  private $username;
  private $password;
  private $database;
  public $pdo=null;

  private static $_instance = null;
  private function __construct() {
    $this->host = env('DB_HOST');
    $this->port = env('DB_PORT');
    $this->username = env('DB_USERNAME');
    $this->password = env('DB_PASSWORD');
    $this->database = env('DB_DATABASE');
    $this->connect();
  }

  public static function getInstance()
  {
    if(self::$_instance == null){
      self::$_instance = new Connection();
    }
    return self::$_instance;
  }
  private function connect()
  {
    try {
      $options = array(
        \PDO::ATTR_EMULATE_PREPARES => false,
        \PDO::ATTR_PERSISTENT => false,
        \PDO::ATTR_ERRMODE => false,
        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
      );
      $dsn ='mysql:host=' . $this->host.'; dbname=' . $this->database;

      $this->pdo = new \PDO(
        $dsn,
        $this->username,
        $this->password,
        $options
      );
      
    } catch (\PDOException $e) {
      myEcho("Holaf, Algo sucedio Error,". $e->getMessage());
      throw $e;
    }
  }

  public  function getConnection()
  {
    return $this->pdo;
  }
}