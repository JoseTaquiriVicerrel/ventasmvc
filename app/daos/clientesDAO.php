<?php

namespace App\Daos;

use Libs\Dao;

class ClientesDAO extends Dao
{
    public function __construct()
    {
        $this->loadConnection();
    }

    public function GetAll()
    {
        $sql = "SELECT IdCliente, Nombre, Apellido, Direccion, Telf, CreditoLim, Ruc FROM  Clientes";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }

    public function get(int $id)
    {
        $result = null;
        if ($id > 0) {
            $sql = "SELECT ID, Nombre, Apellido, Direccion, Telf, CreditoLim, Ruc FROM Clientes where ID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_OBJ);
        }
        return $result;
    }

    public function create($obj)
    {
        $sql = "INSERT INTO Clientes ( Nombre, Apellido, Direccion, Telf, CreditoLim, Ruc) values (?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $obj->Nombre, \PDO::PARAM_STR);
        $stmt->bindParam(2, $obj->Apellido, \PDO::PARAM_STR);
        $stmt->bindParam(3, $obj->Direccion, \PDO::PARAM_STR);
        $stmt->bindParam(4, $obj->Telf, \PDO::PARAM_STR);
        $stmt->bindParam(5, $obj->CreditoLim, \PDO::PARAM_STR);
        $stmt->bindParam(6, $obj->Ruc, \PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function update($obj)
    {
        $sql = "UPDATE Clientes SET  Nombre = ? , Descripcion = ? , Apellido= ?, Direccion= ?, Telf= ?, CreditoLim= ?, Ruc = ? WHERE ID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $obj->Nombre, \PDO::PARAM_STR);
        $stmt->bindParam(2, $obj->Apellido, \PDO::PARAM_STR);
        $stmt->bindParam(3, $obj->Direccion, \PDO::PARAM_STR);
        $stmt->bindParam(4, $obj->Telf, \PDO::PARAM_STR);
        $stmt->bindParam(5, $obj->CreditoLim, \PDO::PARAM_STR);
        $stmt->bindParam(6, $obj->Ruc, \PDO::PARAM_STR);
        $stmt->bindParam(7, $obj->ID, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM  Clientes  WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
