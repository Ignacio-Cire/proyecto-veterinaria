

<?php

class Compraitem extends BaseDatos {
    private $idCompraItem;
    private $idProducto;
    private $idCompra;
    private $ciCantidad;
    private $mensajeOperacion;

    public function __construct() {
        parent::__construct();
        $this->idCompraItem = "";
        $this->idProducto = "";
        $this->idCompra = "";
        $this->ciCantidad = 0;
        $this->mensajeOperacion = "";
    }

    // Métodos de establecimiento (Setters)
    public function setear($idCompraItem, $idProducto, $idCompra, $ciCantidad) {
        $this->setIdCompraItem($idCompraItem);
        $this->setIdProducto($idProducto);
        $this->setIdCompra($idCompra);
        $this->setCiCantidad($ciCantidad);
    }

    // Cargar datos desde la base de datos
    public function cargar() {
        $resp = false;
        $sql = "SELECT * FROM compraitem WHERE idcompraitem = '" . $this->getIdCompraItem() . "'";
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $this->Registro();
                    $this->setear($row['idcompraitem'], $row['idproducto'], $row['idcompra'], $row['cicantidad']);
                }
            }
        } else {
            $this->setMensajeOperacion("compraitem->cargar: " . $this->getError());
        }
        return $resp;
    }

    // Insertar un nuevo item de compra
    public function insertar() {
        $resp = false;
        $sql = "INSERT INTO compraitem (idproducto, idcompra, cicantidad) 
                VALUES (" . $this->getIdProducto() . ", " . $this->getIdCompra() . ", " . $this->getCiCantidad() . ")";
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("compraitem->insertar: " . $this->getError());
            }
        } else {
            $this->setMensajeOperacion("compraitem->insertar: " . $this->getError());
        }
        return $resp;
    }

    // Modificar un item de compra
    public function modificar() {
        $resp = false;
        $sql = "UPDATE compraitem SET idproducto = " . $this->getIdProducto() . ", 
                idcompra = " . $this->getIdCompra() . ", cicantidad = " . $this->getCiCantidad() . "
                WHERE idcompraitem = " . $this->getIdCompraItem();

        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("compraitem->modificar: " . $this->getError());
            }
        } else {
            $this->setMensajeOperacion("compraitem->modificar: " . $this->getError());
        }
        return $resp;
    }

    // Eliminar un item de compra
    public function eliminar() {
        $resp = false;
        $sql = "DELETE FROM compraitem WHERE idcompraitem = '" . $this->getIdCompraItem() . "'";
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("compraitem->eliminar: " . $this->getError());
            }
        } else {
            $this->setMensajeOperacion("compraitem->eliminar: " . $this->getError());
        }
        return $resp;
    }

    // Listar los items de compra
    public function listar($parametro = "") {
        $arreglo = array();
        $sql = "SELECT * FROM compraitem";
        if ($parametro != "") {
            $sql .= " WHERE " . $parametro;
        }
        $res = $this->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $this->Registro()) {
                    $obj = new CompraItem();
                    $obj->setear($row['idcompraitem'], $row['idproducto'], $row['idcompra'], $row['cicantidad']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("compraitem->listar: " . $this->getError());
        }
        return $arreglo;
    }

    // Métodos getter y setter
    public function getIdCompraItem() {
        return $this->idCompraItem;
    }

    public function setIdCompraItem($idCompraItem) {
        $this->idCompraItem = $idCompraItem;
    }

    public function getIdProducto() {
        return $this->idProducto;
    }

    public function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    public function getIdCompra() {
        return $this->idCompra;
    }

    public function setIdCompra($idCompra) {
        $this->idCompra = $idCompra;
    }

    public function getCiCantidad() {
        return $this->ciCantidad;
    }

    public function setCiCantidad($ciCantidad) {
        $this->ciCantidad = $ciCantidad;
    }

    public function getMensajeOperacion() {
        return $this->mensajeOperacion;
    }

    public function setMensajeOperacion($mensajeOperacion) {
        $this->mensajeOperacion = $mensajeOperacion;
    }
}
?>
