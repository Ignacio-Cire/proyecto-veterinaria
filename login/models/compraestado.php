<?php

class CompraEstado extends BaseDatos {
    private $idCompraEstado;
    private $idCompra;
    private $idCompraEstadoTipo;
    private $ceFechaIni;
    private $ceFechaFin;
    private $mensajeOperacion;

    public function __construct() {
        parent::__construct();
        $this->idCompraEstado = 0;
        $this->idCompra = 0;
        $this->idCompraEstadoTipo = 0;
        $this->ceFechaIni = "";
        $this->ceFechaFin = "";
        $this->mensajeOperacion = "";
    }

    // Métodos de establecimiento (Setters)
    public function setear($idCompraEstado, $idCompra, $idCompraEstadoTipo, $ceFechaIni, $ceFechaFin) {
        $this->setIdCompraEstado($idCompraEstado);
        $this->setIdCompra($idCompra);
        $this->setIdCompraEstadoTipo($idCompraEstadoTipo);
        $this->setCeFechaIni($ceFechaIni);
        $this->setCeFechaFin($ceFechaFin);
    }

    // Métodos de obtención (Getters)
    public function getIdCompraEstado() {
        return $this->idCompraEstado;
    }

    public function getIdCompra() {
        return $this->idCompra;
    }

    public function getIdCompraEstadoTipo() {
        return $this->idCompraEstadoTipo;
    }

    public function getCeFechaIni() {
        return $this->ceFechaIni;
    }

    public function getCeFechaFin() {
        return $this->ceFechaFin;
    }

    // Métodos de operación (Acceso a la base de datos)
    public function insertar() {
        $consulta = "INSERT INTO compraestado (idcompra, idcompraestadotipo, cefechaini, cefechafin) VALUES (" 
            . $this->getIdCompra() . ", " 
            . $this->getIdCompraEstadoTipo() . ", '" 
            . $this->getCeFechaIni() . "', '" 
            . $this->getCeFechaFin() . "')";
        $resultado = $this->execQuery($consulta);
        return $resultado;
    }

    public function modificar() {
        $consulta = "UPDATE compraestado SET idcompra = " . $this->getIdCompra() . ", "
            . "idcompraestadotipo = " . $this->getIdCompraEstadoTipo() . ", "
            . "cefechaini = '" . $this->getCeFechaIni() . "', "
            . "cefechafin = '" . $this->getCeFechaFin() . "' "
            . "WHERE idcompraestado = " . $this->getIdCompraEstado();
        $resultado = $this->execQuery($consulta);
        return $resultado;
    }

    public function eliminar() {
        $consulta = "DELETE FROM compraestado WHERE idcompraestado = " . $this->getIdCompraEstado();
        $resultado = $this->execQuery($consulta);
        return $resultado;
    }

    public function buscarPorId($idCompraEstado) {
        $consulta = "SELECT * FROM compraestado WHERE idcompraestado = " . $idCompraEstado;
        $resultado = $this->execQuery($consulta);
        if ($resultado) {
            $row = $resultado->fetch_assoc();
            $this->setear($row['idcompraestado'], $row['idcompra'], $row['idcompraestadotipo'], 
                          $row['cefechaini'], $row['cefechafin']);
        }
        return $this;
    }

    public function listar() {
        $consulta = "SELECT * FROM compraestado";
        $resultado = $this->execQuery($consulta);
        $listado = [];
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $compraEstado = new CompraEstado();
                $compraEstado->setear($row['idcompraestado'], $row['idcompra'], $row['idcompraestadotipo'], 
                                      $row['cefechaini'], $row['cefechafin']);
                $listado[] = $compraEstado;
            }
        }
        return $listado;
    }

    // Métodos de establecimiento (Setters)
    private function setIdCompraEstado($idCompraEstado) {
        $this->idCompraEstado = $idCompraEstado;
    }

    private function setIdCompra($idCompra) {
        $this->idCompra = $idCompra;
    }

    private function setIdCompraEstadoTipo($idCompraEstadoTipo) {
        $this->idCompraEstadoTipo = $idCompraEstadoTipo;
    }

    private function setCeFechaIni($ceFechaIni) {
        $this->ceFechaIni = $ceFechaIni;
    }

    private function setCeFechaFin($ceFechaFin) {
        $this->ceFechaFin = $ceFechaFin;
    }
}

?>
