<?php

namespace App\Daos;

use Libs\Dao;

class PermisosDAO extends Dao
{
    public function __construct()
    {
        $this->loadConnection();
    }

    public function GetAll()
    {
        $sql = "SELECT IdPermiso, IdTipo, Tabla FROM  Permisos";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }

    public function get(int $id)
    {
        $result = null;
        if ($id > 0) {
            $sql = "SELECT ID, IdTipo, Tabla FROM Permiso where ID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_OBJ);
        }
        return $result;
    }

    public function create($obj)
    {
        $sql = "INSERT INTO Permisos ( IdTipo, Tabla) values (?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $obj->IdTipo, \PDO::PARAM_STR);
        $stmt->bindParam(2, $obj->Tabla, \PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function update($obj)
    {
        $sql = "UPDATE Permisos SET  IdTipo = ?, Tabla = ? WHERE ID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $obj->IdTipo, \PDO::PARAM_STR);
        $stmt->bindParam(2, $obj->Tabla, \PDO::PARAM_STR);
        $stmt->bindParam(3, $obj->ID, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM  Permisos  WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
