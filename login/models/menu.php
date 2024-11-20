<?php

class Menu extends BaseDatos {
    private $idMenu;
    private $nombre;
    private $descripcion;
    private $idPadre;
    private $deshabilitado;
    private $mensajeOperacion;

    public function __construct() {
        parent::__construct();
        $this->idMenu = "";
        $this->nombre = "";
        $this->descripcion = "";
        $this->idPadre = null;
        $this->deshabilitado = null;
        $this->mensajeOperacion = "";
    }

    // Métodos de establecimiento (Setters)
    public function setear($idMenu, $nombre, $descripcion, $idPadre, $deshabilitado) {
        $this->setIdMenu($idMenu);
        $this->setNombre($nombre);
        $this->setDescripcion($descripcion);
        $this->setIdPadre($idPadre);
        $this->setDeshabilitado($deshabilitado);
    }

    public function setearSinID($nombre, $descripcion, $idPadre, $deshabilitado) {
        $this->setNombre($nombre);
        $this->setDescripcion($descripcion);
        $this->setIdPadre($idPadre);
        $this->setDeshabilitado($deshabilitado);
    }

    // Cargar datos desde la base de datos
    public function cargar() {
        $resp = false;
        $sql = "SELECT * FROM menu WHERE idmenu = '" . $this->getIdMenu() . "'";
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $this->Registro();
                    $this->setear($row['idmenu'], $row['menombre'], $row['medescripcion'], $row['idpadre'], $row['medeshabilitado']);
                }
            }
        } else {
            $this->setMensajeOperacion("menu->cargar: " . $this->getError());
        }
        return $resp;
    }

    // Insertar un nuevo item en el menú
    public function insertar() {
        $resp = false;
        $sql = "INSERT INTO menu (menombre, medescripcion, idpadre, medeshabilitado) 
                VALUES ('" . $this->getNombre() . "', '" . $this->getDescripcion() . "', '" . $this->getIdPadre() . "', '" . $this->getDeshabilitado() . "')";
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("menu->insertar: " . $this->getError());
            }
        } else {
            $this->setMensajeOperacion("menu->insertar: " . $this->getError());
        }
        return $resp;
    }

    // Modificar los datos del menú
    public function modificar() {
        $resp = false;
        $sql = "UPDATE menu SET menombre = '" . $this->getNombre() . "', 
                                 medescripcion = '" . $this->getDescripcion() . "', 
                                 idpadre = '" . $this->getIdPadre() . "', 
                                 medeshabilitado = '" . $this->getDeshabilitado() . "' 
                WHERE idmenu = '" . $this->getIdMenu() . "'";

        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("menu->modificar: " . $this->getError());
            }
        } else {
            $this->setMensajeOperacion("menu->modificar: " . $this->getError());
        }
        return $resp;
    }

    // Eliminar un item del menú
    public function eliminar() {
        $resp = false;
        $sql = "DELETE FROM menu WHERE idmenu = '" . $this->getIdMenu() . "'";
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("menu->eliminar: " . $this->getError());
            }
        } else {
            $this->setMensajeOperacion("menu->eliminar: " . $this->getError());
        }
        return $resp;
    }

    // Listar todos los items del menú
    public function listar($parametro = "") {
        $arreglo = array();
        $sql = "SELECT * FROM menu";
        if ($parametro != "") {
            $sql .= " WHERE " . $parametro;
        }
        $res = $this->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $this->Registro()) {
                    $obj = new Menu();
                    $obj->setear($row['idmenu'], $row['menombre'], $row['medescripcion'], $row['idpadre'], $row['medeshabilitado']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("menu->listar: " . $this->getError());
        }
        return $arreglo;
    }

    // Métodos getter y setter
    public function getIdMenu() {
        return $this->idMenu;
    }

    public function setIdMenu($idMenu) {
        $this->idMenu = $idMenu;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getIdPadre() {
        return $this->idPadre;
    }

    public function setIdPadre($idPadre) {
        $this->idPadre = $idPadre;
    }

    public function getDeshabilitado() {
        return $this->deshabilitado;
    }

    public function setDeshabilitado($deshabilitado) {
        $this->deshabilitado = $deshabilitado;
    }

    public function getMensajeOperacion() {
        return $this->mensajeOperacion;
    }

    public function setMensajeOperacion($mensajeOperacion) {
        $this->mensajeOperacion = $mensajeOperacion;
    }
}
?>
