<?php 
namespace Libs;
class Dao
{
  protected $pdo;
  protected $db;
  public function loadConnection()
  {
    $this->pdo = Connection::getInstance()->getConnection();
  }

  public function loadEloquent()
  {
    $this->db = new Database();
  }
}
