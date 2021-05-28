<?php
namespace App\Daos;
use Libs\Dao;
class CategoriaDAO extends Dao
{
  public function __construct() {
    $this->loadConnection();
  }

  public function GetAll()
  {
    $sql = "SELECT ID, Nombre, Descripcion,Estado FROM  Categorias";
    myEcho( $this->pdo);
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
    return $result;
  }

  public function get(int $id)
  {
    $result = null;
    if ($id>0) {
      $sql = "SELECT ID, Nombre, Descripcion,Estado FROM Categorias where ID = ?";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindParam(1, $id,\PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch(\PDO::FETCH_OBJ);
    }
    return $result;
  }
}