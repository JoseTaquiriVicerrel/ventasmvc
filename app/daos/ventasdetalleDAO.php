<?php

namespace App\Daos;

use Libs\Dao;

class VentasDetalleDAO extends Dao
{
    public function __construct()
    {
        $this->loadConnection();
    }

    public function GetAll()
    {
        $sql = "SELECT IdVentasDetalle,IdVenta, IdProducto, Cantidad, PrecioVenta, PrecioCosto, Item FROM  VentasDetalle";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }

    public function get(int $id)
    {
        $result = null;
        if ($id > 0) {
            $sql = "SELECT ID, IdVenta, IdProducto, Cantidad, PrecioVenta, PrecioCosto, Item  FROM VentasDetalle where ID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_OBJ);
        }
        return $result;
    }

    public function create($obj)
    {
        $sql = "INSERT INTO VentasDetalle ( IdVenta, IdProducto, Cantidad, PrecioVenta, PrecioCosto, Item ) values (?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $obj->IdVenta, \PDO::PARAM_STR);
        $stmt->bindParam(2, $obj->IdProducto, \PDO::PARAM_STR);
        $stmt->bindParam(3, $obj->Cantidad, \PDO::PARAM_STR);
        $stmt->bindParam(4, $obj->PrecioVenta, \PDO::PARAM_STR);
        $stmt->bindParam(5, $obj->PrecioCosto, \PDO::PARAM_STR);
        $stmt->bindParam(6, $obj->Item, \PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function update($obj)
    {
        $sql = "UPDATE VentasDetalle SET  IdVenta = ?, IdProducto= ?,Cantidad= ?,PrecioVenta= ?, PrecioCosto= ?, Item= ? WHERE ID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $obj->IdVenta, \PDO::PARAM_STR);
        $stmt->bindParam(2, $obj->IdProducto, \PDO::PARAM_STR);
        $stmt->bindParam(3, $obj->Cantidad, \PDO::PARAM_STR);
        $stmt->bindParam(4, $obj->PrecioVenta, \PDO::PARAM_STR);
        $stmt->bindParam(5, $obj->PrecioCosto, \PDO::PARAM_STR);
        $stmt->bindParam(6, $obj->Item, \PDO::PARAM_STR);
        $stmt->bindParam(7, $obj->ID, \PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM  VentasDetalle  WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
