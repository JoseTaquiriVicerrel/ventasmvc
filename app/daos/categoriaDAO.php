<?php
namespace App\Daos;

use App\Models\CategoriaModel;
use Libs\Dao;
class CategoriaDAO extends Dao
{
  public function __construct() {
    $this->loadEloquent();
  }

  public function GetAll(bool $estado)
  {
    $result = CategoriaModel::where('Estado',$estado)->orderBy('IdCateg','DESC')->get();
    return $result;
  }

  public function get(int $id)
  {
    $result = null;
    if ($id>0) {
      $result = CategoriaModel::find($id);
    }
    return $result;
  }

  public function create($obj)
  {
    $rpta = CategoriaModel::create($obj);
    return $rpta;
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