<?php

namespace App\Daos;

use Libs\Dao;

class MarcasDAO extends Dao
{
    public function __construct()
    {
        $this->loadConnection();
    }

    public function GetAll()
    {
        $sql = "SELECT IdMarca, Nombre, Descripcion FROM  Marcas";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }

    public function get(int $id)
    {
        $result = null;
        if ($id > 0) {
            $sql = "SELECT ID, Nombre, Descripcion FROM Marcas where ID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_OBJ);
        }
        return $result;
    }

    public function create($obj)
    {
        $sql = "INSERT INTO Marcas ( Nombre, Descripcion) values (?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $obj->Nombre, \PDO::PARAM_STR);
        $stmt->bindParam(2, $obj->Descripcion, \PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function update($obj)
    {
        $sql = "UPDATE Marcas SET  Nombre = ? , Descripcion = ? WHERE ID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $obj->Nombre, \PDO::PARAM_STR);
        $stmt->bindParam(2, $obj->Descripcion, \PDO::PARAM_STR);
        $stmt->bindParam(3, $obj->ID, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM  Marcas  WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
