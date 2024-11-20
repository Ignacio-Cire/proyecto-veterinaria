<?php

class Producto extends BaseDatos {
    private $idProducto;
    private $proNombre;
    private $proDetalle;
    private $proCantStock;
    private $mensajeOperacion;

    public function __construct() {
        parent::__construct();
        $this->idProducto = "";
        $this->proNombre = "";
        $this->proDetalle = "";
        $this->proCantStock = 0;
        $this->mensajeOperacion = "";
    }

    // Métodos de establecimiento (Setters)
    public function setear($idProducto, $proNombre, $proDetalle, $proCantStock) {
        $this->setIdProducto($idProducto);
        $this->setProNombre($proNombre);
        $this->setProDetalle($proDetalle);
        $this->setProCantStock($proCantStock);
    }

    // Cargar datos desde la base de datos
    public function cargar() {
        $resp = false;
        $sql = "SELECT * FROM producto WHERE idproducto = '" . $this->getIdProducto() . "'";
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $this->Registro();
                    $this->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock']);
                }
            }
        } else {
            $this->setMensajeOperacion("producto->cargar: " . $this->getError());
        }
        return $resp;
    }

    // Insertar un nuevo producto
    public function insertar() {
        $resp = false;
        $sql = "INSERT INTO producto (pronombre, prodetalle, procantstock) 
                VALUES ('" . $this->getProNombre() . "', '" . $this->getProDetalle() . "', " . $this->getProCantStock() . ")";
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("producto->insertar: " . $this->getError());
            }
        } else {
            $this->setMensajeOperacion("producto->insertar: " . $this->getError());
        }
        return $resp;
    }

    // Modificar los datos de un producto
    public function modificar() {
        $resp = false;
        $sql = "UPDATE producto SET pronombre = '" . $this->getProNombre() . "', 
                prodetalle = '" . $this->getProDetalle() . "', procantstock = " . $this->getProCantStock() . "
                WHERE idproducto = '" . $this->getIdProducto() . "'";

        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("producto->modificar: " . $this->getError());
            }
        } else {
            $this->setMensajeOperacion("producto->modificar: " . $this->getError());
        }
        return $resp;
    }

    // Eliminar un producto
    public function eliminar() {
        $resp = false;
        $sql = "DELETE FROM producto WHERE idproducto = '" . $this->getIdProducto() . "'";
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("producto->eliminar: " . $this->getError());
            }
        } else {
            $this->setMensajeOperacion("producto->eliminar: " . $this->getError());
        }
        return $resp;
    }

    // Listar todos los productos o los que coincidan con el parámetro
    public function listar($parametro = "") {
        $arreglo = array();
        $sql = "SELECT * FROM producto";
        if ($parametro != "") {
            $sql .= " WHERE " . $parametro;
        }
        $res = $this->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $this->Registro()) {
                    $obj = new Producto();
                    $obj->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("producto->listar: " . $this->getError());
        }
        return $arreglo;
    }

    // Métodos getter y setter
    public function getIdProducto() {
        return $this->idProducto;
    }

    public function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    public function getProNombre() {
        return $this->proNombre;
    }

    public function setProNombre($proNombre) {
        $this->proNombre = $proNombre;
    }

    public function getProDetalle() {
        return $this->proDetalle;
    }

    public function setProDetalle($proDetalle) {
        $this->proDetalle = $proDetalle;
    }

    public function getProCantStock() {
        return $this->proCantStock;
    }

    public function setProCantStock($proCantStock) {
        $this->proCantStock = $proCantStock;
    }

    public function getMensajeOperacion() {
        return $this->mensajeOperacion;
    }

    public function setMensajeOperacion($mensajeOperacion) {
        $this->mensajeOperacion = $mensajeOperacion;
    }
}
?>
