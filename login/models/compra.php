
<?php

class Compra extends BaseDatos {
    private $idCompra;
    private $coFecha;
    private $idUsuario;
    private $mensajeOperacion;

    public function __construct() {
        parent::__construct();
        $this->idCompra = 0;
        $this->coFecha = "";
        $this->idUsuario = 0;
        $this->mensajeOperacion = "";
    }

    // Métodos de establecimiento (Setters)
    public function setear($idCompra, $coFecha, $idUsuario) {
        $this->setIdCompra($idCompra);
        $this->setCoFecha($coFecha);
        $this->setIdUsuario($idUsuario);
    }

    // Métodos de obtención (Getters)
    public function getIdCompra() {
        return $this->idCompra;
    }

    public function getCoFecha() {
        return $this->coFecha;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    // Métodos de operación (Acceso a la base de datos)
    public function insertar() {
        $consulta = "INSERT INTO compra (cofecha, idusuario) VALUES ('" 
            . $this->getCoFecha() . "', " 
            . $this->getIdUsuario() . ")";
        $resultado = $this->execQuery($consulta);
        return $resultado;
    }

    public function modificar() {
        $consulta = "UPDATE compra SET cofecha = '" . $this->getCoFecha() . "', "
            . "idusuario = " . $this->getIdUsuario() . " "
            . "WHERE idcompra = " . $this->getIdCompra();
        $resultado = $this->execQuery($consulta);
        return $resultado;
    }

    public function eliminar() {
        $consulta = "DELETE FROM compra WHERE idcompra = " . $this->getIdCompra();
        $resultado = $this->execQuery($consulta);
        return $resultado;
    }

    public function buscarPorId($idCompra) {
        $consulta = "SELECT * FROM compra WHERE idcompra = " . $idCompra;
        $resultado = $this->execQuery($consulta);
        if ($resultado) {
            $row = $resultado->fetch_assoc();
            $this->setear($row['idcompra'], $row['cofecha'], $row['idusuario']);
        }
        return $this;
    }

    public function listar() {
        $consulta = "SELECT * FROM compra";
        $resultado = $this->execQuery($consulta);
        $listado = [];
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $compra = new Compra();
                $compra->setear($row['idcompra'], $row['cofecha'], $row['idusuario']);
                $listado[] = $compra;
            }
        }
        return $listado;
    }

    // Métodos de establecimiento (Setters)
    private function setIdCompra($idCompra) {
        $this->idCompra = $idCompra;
    }

    private function setCoFecha($coFecha) {
        $this->coFecha = $coFecha;
    }

    private function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }
}

?>
