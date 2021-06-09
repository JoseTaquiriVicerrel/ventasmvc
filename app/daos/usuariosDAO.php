<?php

namespace App\Daos;

use Libs\Dao;

class UsuariosDAO extends Dao
{
    public function __construct()
    {
        $this->loadConnection();
    }

    public function GetAll(bool $Estado)
    {
        $sql = "SELECT IdUsuario,IdTipo, Apellido, Nombre, Direccion, Telf, Usuario , Clave, Correo, FCreacion, FEliminacion FROM  Usuarios where Estado" ;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }

    public function get(int $id)
    {
        $result = null;
        if ($id > 0) {
            $sql = "SELECT ID, IdTipo, Apellido, Nombre, Direccion, Telf, Usuario , Clave, Correo, FCreacion, FEliminacion  FROM Usuarios where ID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_OBJ);
        }
        return $result;
    }

    public function create($obj)
    {
        $sql = "INSERT INTO Usuario ( IdTipo, Apellido, Nombre, Direccion, Telf, Usuario , Clave, Correo, FCreacion, FEliminacion ) values (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $obj->IdTipo, \PDO::PARAM_STR);
        $stmt->bindParam(2, $obj->Apellido, \PDO::PARAM_STR);
        $stmt->bindParam(3, $obj->Nombre, \PDO::PARAM_STR);
        $stmt->bindParam(4, $obj->Direccion, \PDO::PARAM_STR);
        $stmt->bindParam(5, $obj->Telf, \PDO::PARAM_STR);
        $stmt->bindParam(6, $obj->Usuario, \PDO::PARAM_STR);
        $stmt->bindParam(7, $obj->Clave, \PDO::PARAM_STR);
        $stmt->bindParam(8, $obj->Correo, \PDO::PARAM_STR);
        $stmt->bindParam(9, $obj->FCreacion, \PDO::PARAM_STR);
        $stmt->bindParam(10, $obj->FEliminacion, \PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function update($obj)
    {
        $sql = "UPDATE Usuario SET  IdTipo = ?, Apellido= ?,Nombre= ?,Direccion= ?, Telf= ?, Usuario= ?, Clave = ?, Correo= ?, FCreacion= ?,FEliminacion= ? WHERE ID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $obj->IdTipo, \PDO::PARAM_STR);
        $stmt->bindParam(2, $obj->Apellido, \PDO::PARAM_STR);
        $stmt->bindParam(3, $obj->Nombre, \PDO::PARAM_STR);
        $stmt->bindParam(4, $obj->Direccion, \PDO::PARAM_STR);
        $stmt->bindParam(5, $obj->Telf, \PDO::PARAM_STR);
        $stmt->bindParam(6, $obj->Usuario, \PDO::PARAM_STR);
        $stmt->bindParam(7, $obj->Clave, \PDO::PARAM_STR);
        $stmt->bindParam(8, $obj->Correo, \PDO::PARAM_STR);
        $stmt->bindParam(9, $obj->FCreacion, \PDO::PARAM_STR);
        $stmt->bindParam(10, $obj->FEliminacion, \PDO::PARAM_STR);
        $stmt->bindParam(11, $obj->ID, \PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM  Usuario  WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
