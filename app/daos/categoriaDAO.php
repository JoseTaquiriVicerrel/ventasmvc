<?php
namespace App\Daos;
use Libs\Dao;
class CategoriaDAO extends Dao
{
  public function __construct() {
    $this->loadConnection();
  }

  public function GetAll(bool $estado)
  {
    $sql = "SELECT IdCateg, Nombre, Descripcion,Estado FROM  Categorias where Estado = ? ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(1, $estado,\PDO::PARAM_BOOL);
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

  public function create($obj)
  {
      $sql = "INSERT INTO Categorias ( Nombre, Descripcion,Estado) values (?,?,?)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindParam(1, $obj->Nombre, \PDO::PARAM_STR);
      $stmt->bindParam(2, $obj->Descripcion, \PDO::PARAM_STR);
      $stmt->bindParam(3, $obj->Estado, \PDO::PARAM_BOOL);
      
    return $stmt->execute();
  }
  public function update($obj)
  {
    $sql = "UPDATE Categorias SET  Nombre = ? , Descripcion = ? , Estado = ? WHERE IdCateg = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(1, $obj->Nombre, \PDO::PARAM_STR);
    $stmt->bindParam(2, $obj->Descripcion, \PDO::PARAM_STR);
    $stmt->bindParam(3, $obj->Estado, \PDO::PARAM_BOOL);
    $stmt->bindParam(4, $obj->ID, \PDO::PARAM_INT);
    return $stmt->execute();
  }

  public function delete(int $id)
  {
    $sql = "DELETE FROM  Categorias  WHERE IdCateg = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam( 1, $id, \PDO::PARAM_INT);
    return $stmt->execute();
  }


}