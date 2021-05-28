<?php 
namespace Libs;
class Dao
{
  protected $pdo;
  public function loadConnection()
  {
    $this->pdo = Connection::getInstance()->getConnection();
  }
}
