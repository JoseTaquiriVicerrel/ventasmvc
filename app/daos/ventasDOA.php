<?php

namespace App\Daos;

use Libs\Dao;

class VentasDAO extends Dao
{
    public function __construct()
    {
        $this->loadConnection();
    }

    public function GetAll()
    {
        $sql = "SELECT IdVenta,IdUsuario, IdCliente, IdFormaPago, IdComprobante, Serie, PrecioCosto , FEmision, HEmision, Sub Total, IGV, Total, Cancelado, PorcentajeIGV, Pago, Cambio FROM  Ventas";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }

    public function get(int $id)
    {
        $result = null;
        if ($id > 0) {
            $sql = "SELECT ID, IdUsuario, IdCliente, IdFormaPago, IdComprobante, Serie, PrecioCosto , FEmision, HEmision, Sub Total, IGV, Total, Cancelado, PorcentajeIGV, Pago, Cambio  FROM Ventas where ID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_OBJ);
        }
        return $result;
    }

    public function create($obj)
    {
        $sql = "INSERT INTO Ventas ( IdUsuario, IdCliente, IdFormaPago, IdComprobante, Serie, PrecioCosto , FEmision, HEmision, Sub Total, IGV, Total, Cancelado, PorcentajeIGV, Pago, Cambio ) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $obj->IdUsuario, \PDO::PARAM_STR);
        $stmt->bindParam(2, $obj->IdCliente, \PDO::PARAM_STR);
        $stmt->bindParam(3, $obj->IdFormaPago, \PDO::PARAM_STR);
        $stmt->bindParam(4, $obj->IdComprobante, \PDO::PARAM_STR);
        $stmt->bindParam(5, $obj->Serie, \PDO::PARAM_STR);
        $stmt->bindParam(6, $obj->PrecioCosto, \PDO::PARAM_STR);
        $stmt->bindParam(7, $obj->FEmision, \PDO::PARAM_STR);
        $stmt->bindParam(8, $obj->HEmision, \PDO::PARAM_STR);
        $stmt->bindParam(9, $obj->Sub_Total, \PDO::PARAM_STR);
        $stmt->bindParam(10, $obj->IGV, \PDO::PARAM_STR);
        $stmt->bindParam(11, $obj->Total, \PDO::PARAM_STR);
        $stmt->bindParam(12, $obj->cancelado, \PDO::PARAM_STR);
        $stmt->bindParam(13, $obj->PorcentajeIGV, \PDO::PARAM_STR);
        $stmt->bindParam(14, $obj->Pago, \PDO::PARAM_STR);
        $stmt->bindParam(15, $obj->Cambio, \PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function update($obj)
    {
        $sql = "UPDATE Ventas SET  IdUsuario = ?, IdCliente= ?,IdFormaPago= ?,IdComprobante= ?, Serie= ?, PrecioCosto= ?, FEmision = ?, HEmision= ?, Sub Total= ?, Total=?,Canceledao=?,PorcentajeIGV=?,Pago=?,Cambio =?WHERE ID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $obj->IdUsuario, \PDO::PARAM_STR);
        $stmt->bindParam(2, $obj->IdCliente, \PDO::PARAM_STR);
        $stmt->bindParam(3, $obj->IdFormaPago, \PDO::PARAM_STR);
        $stmt->bindParam(4, $obj->IdComprobante, \PDO::PARAM_STR);
        $stmt->bindParam(5, $obj->Serie, \PDO::PARAM_STR);
        $stmt->bindParam(6, $obj->PrecioCosto, \PDO::PARAM_STR);
        $stmt->bindParam(7, $obj->FEmision, \PDO::PARAM_STR);
        $stmt->bindParam(8, $obj->HEmision, \PDO::PARAM_STR);
        $stmt->bindParam(9, $obj->Sub_Total, \PDO::PARAM_STR);
        $stmt->bindParam(10, $obj->IGV, \PDO::PARAM_STR);
        $stmt->bindParam(11, $obj->Total, \PDO::PARAM_STR);
        $stmt->bindParam(12, $obj->cancelado, \PDO::PARAM_STR);
        $stmt->bindParam(13, $obj->PorcentajeIGV, \PDO::PARAM_STR);
        $stmt->bindParam(14, $obj->Pago, \PDO::PARAM_STR);
        $stmt->bindParam(15, $obj->Cambio, \PDO::PARAM_STR);
        $stmt->bindParam(16, $obj->ID, \PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM  Ventas  WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
