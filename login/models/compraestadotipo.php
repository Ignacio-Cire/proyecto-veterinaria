<?php

class compraestadotipo extends BaseDatos {
    private $idcompraestadotipo;
    private $cetDescripcion;
    private $cetDetalle;
    private $mensajeOperacion;

    public function __construct() {
        parent::__construct();
        $this->idcompraestadotipo = 0;
        $this->cetDescripcion = "";
        $this->cetDetalle = "";
        $this->mensajeOperacion = "";
    }

    // Métodos de establecimiento (Setters)
    public function setear($idcompraestadotipo, $cetDescripcion, $cetDetalle) {
        $this->setIdcompraestadotipo($idcompraestadotipo);
        $this->setCetDescripcion($cetDescripcion);
        $this->setCetDetalle($cetDetalle);
    }

    // Métodos de obtención (Getters)
    public function getIdcompraestadotipo() {
        return $this->idcompraestadotipo;
    }

    public function getCetDescripcion() {
        return $this->cetDescripcion;
    }

    public function getCetDetalle() {
        return $this->cetDetalle;
    }

    // Métodos de operación (Acceso a la base de datos)
    public function insertar() {
        $consulta = "INSERT INTO compraestadotipo (cetdescripcion, cetdetalle) VALUES ('" . $this->getCetDescripcion() . "', '" . $this->getCetDetalle() . "')";
        $resultado = $this->execQuery($consulta);
        return $resultado;
    }

    public function modificar() {
        $consulta = "UPDATE compraestadotipo SET cetdescripcion = '" . $this->getCetDescripcion() . "', cetdetalle = '" . $this->getCetDetalle() . "' WHERE idcompraestadotipo = " . $this->getIdcompraestadotipo();
        $resultado = $this->execQuery($consulta);
        return $resultado;
    }

    public function eliminar() {
        $consulta = "DELETE FROM compraestadotipo WHERE idcompraestadotipo = " . $this->getIdcompraestadotipo();
        $resultado = $this->execQuery($consulta);
        return $resultado;
    }

    public function buscarPorId($idcompraestadotipo) {
        $consulta = "SELECT * FROM compraestadotipo WHERE idcompraestadotipo = " . $idcompraestadotipo;
        $resultado = $this->execQuery($consulta);
        if ($resultado) {
            $row = $resultado->fetch_assoc();
            $this->setear($row['idcompraestadotipo'], $row['cetdescripcion'], $row['cetdetalle']);
        }
        return $this;
    }

    public function listar() {
        $consulta = "SELECT * FROM compraestadotipo";
        $resultado = $this->execQuery($consulta);
        $listado = [];
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $compraestadotipo = new compraestadotipo();
                $compraestadotipo->setear($row['idcompraestadotipo'], $row['cetdescripcion'], $row['cetdetalle']);
                $listado[] = $compraestadotipo;
            }
        }
        return $listado;
    }

    // Métodos de establecimiento (Setters)
    private function setIdcompraestadotipo($idcompraestadotipo) {
        $this->idcompraestadotipo = $idcompraestadotipo;
    }

    private function setCetDescripcion($cetDescripcion) {
        $this->cetDescripcion = $cetDescripcion;
    }

    private function setCetDetalle($cetDetalle) {
        $this->cetDetalle = $cetDetalle;
    }
}

?>
