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
        $sql = "SELECT IdCliente, Nombres, Apellidos, Direccion, Telf, CreditoLimite, Ruc FROM  Clientes";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }

    public function get(int $id)
    {
        $result = null;
        if ($id > 0) {
            $sql = "SELECT ID, Nombres, Apellidos, Direccion, Telf, CreditoLimite, Ruc FROM Clientes where ID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_OBJ);
        }
        return $result;
    }

    public function create($obj)
    {
        $sql = "INSERT INTO Clientes ( Nombres, Apellidos, Direccion, Telf, CreditoLimite, Ruc) values (?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $obj->Nombres, \PDO::PARAM_STR);
        $stmt->bindParam(2, $obj->Apellidos, \PDO::PARAM_STR);
        $stmt->bindParam(3, $obj->Direccion, \PDO::PARAM_STR);
        $stmt->bindParam(4, $obj->Telf, \PDO::PARAM_STR);
        $stmt->bindParam(5, $obj->CreditoLimite, \PDO::PARAM_STR);
        $stmt->bindParam(6, $obj->Ruc, \PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function update($obj)
    {
        $sql = "UPDATE Clientes SET  Nombres = ? , Apellidos= ?, Direccion= ?, Telf= ?, CreditoLimite= ?, Ruc = ? WHERE ID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $obj->Nombres, \PDO::PARAM_STR);
        $stmt->bindParam(2, $obj->Apellidos, \PDO::PARAM_STR);
        $stmt->bindParam(3, $obj->Direccion, \PDO::PARAM_STR);
        $stmt->bindParam(4, $obj->Telf, \PDO::PARAM_STR);
        $stmt->bindParam(5, $obj->CreditoLimite, \PDO::PARAM_STR);
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
