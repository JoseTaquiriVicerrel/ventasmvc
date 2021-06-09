<?php

namespace App\Daos;

use Libs\Dao;

class ProductosDAO extends Dao
{
    public function __construct()
    {
        $this->loadConnection();
    }

    public function GetAll()
    {
        $sql = "SELECT IdProducto,IdMarca, IdCategoria, IdUnidad, Nombre, Descripcion, PrecioCosto , PrecioVenta, Stock, StockMinimo FROM  Productos";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }

    public function get(int $id)
    {
        $result = null;
        if ($id > 0) {
            $sql = "SELECT ID, IdMarca, IdCategoria, IdUnidad, Nombre, Descripcion, PrecioCosto , PrecioVenta, Stock, StockMinimo  FROM Productos where ID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_OBJ);
        }
        return $result;
    }

    public function create($obj)
    {
        $sql = "INSERT INTO Productos ( IdMarca, IdCategoria, IdUnidad, Nombre, Descripcion, PrecioCosto , PrecioVenta, Stock, StockMinimo ) values (?,?,?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $obj->IdMarca, \PDO::PARAM_STR);
        $stmt->bindParam(2, $obj->IdCategoria, \PDO::PARAM_STR);
        $stmt->bindParam(3, $obj->IdUnidad, \PDO::PARAM_STR);
        $stmt->bindParam(4, $obj->Nombre, \PDO::PARAM_STR);
        $stmt->bindParam(5, $obj->Descripcion, \PDO::PARAM_STR);
        $stmt->bindParam(6, $obj->PrecioCosto, \PDO::PARAM_STR);
        $stmt->bindParam(7, $obj->PrecioVenta, \PDO::PARAM_STR);
        $stmt->bindParam(8, $obj->Stock, \PDO::PARAM_STR);
        $stmt->bindParam(9, $obj->StockMinimo, \PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function update($obj)
    {
        $sql = "UPDATE Productos SET  IdMarca = ?, IdCategoria= ?,IdUnidad= ?,Nombre= ?, Descripcion= ?, PrecioCosto= ?, PrecioVenta = ?, Stock= ?, StockMinimo= ? WHERE ID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $obj->IdMarca, \PDO::PARAM_STR);
        $stmt->bindParam(2, $obj->IdCategoria, \PDO::PARAM_STR);
        $stmt->bindParam(3, $obj->IdUnidad, \PDO::PARAM_STR);
        $stmt->bindParam(4, $obj->Nombre, \PDO::PARAM_STR);
        $stmt->bindParam(5, $obj->Descripcion, \PDO::PARAM_STR);
        $stmt->bindParam(6, $obj->PrecioCosto, \PDO::PARAM_STR);
        $stmt->bindParam(7, $obj->PrecioVenta, \PDO::PARAM_STR);
        $stmt->bindParam(8, $obj->Stock, \PDO::PARAM_STR);
        $stmt->bindParam(9, $obj->StockMinimo, \PDO::PARAM_STR);
        $stmt->bindParam(10, $obj->ID, \PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM  Productos  WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
