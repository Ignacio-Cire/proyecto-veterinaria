<?php

class UsuarioRol extends BaseDatos {
    private $idUsuario;
    private $idRol;
    private $mensajeOperacion;

    public function __construct() {
        parent::__construct();
        $this->idUsuario = null;
        $this->idRol = null;
        $this->mensajeOperacion = "";
    }

    // Métodos de seteo
    public function setear($idUsuario, $idRol) {
        $this->setIdUsuario($idUsuario);
        $this->setIdRol($idRol);
    }

    // Getters y Setters
    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($valor) {
        $this->idUsuario = $valor;
    }   

    public function getIdRol() {
        return $this->idRol;
    }

    public function setIdRol($valor) {
        $this->idRol = $valor;
    }

    public function getMensajeOperacion() {
        return $this->mensajeOperacion;
    }

    public function setMensajeOperacion($valor) {
        $this->mensajeOperacion = $valor;
    }

    // Método para insertar una relación usuario-rol
    public function insertar() {
        $resp = false;
        $sql = "INSERT INTO usuariorol (idUsuario, idRol) VALUES ('".$this->getIdUsuario()."', '".$this->getIdRol()."')";
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($this->getError());
            }
        }
        return $resp;
    }

    // Método para eliminar una relación usuario-rol
    public function eliminar() {
        $resp = false;
        $sql = "DELETE FROM usuariorol WHERE idUsuario = ".$this->getIdUsuario()." AND idRol = ".$this->getIdRol();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($this->getError());
            }
        }
        return $resp;
    }

    // Método para obtener el rol de un usuario
    public function seleccionar() {
        $sql = "SELECT * FROM usuariorol WHERE idusuario = ".$this->getIdUsuario();
        if ($this->Iniciar()) {
            $resultado = $this->Ejecutar($sql);
            if ($resultado) {
                $fila = $resultado->fetch_assoc();
                if ($fila) {
                    $this->setear($fila['idusuario'], $fila['idrol']);
                    return true;
                }
            } else {
                $this->setMensajeOperacion($this->getError());
            }
        }
        return false;
    }

    public function listar($parametro = "")
{
    $arreglo = array();
    $sql = "SELECT * FROM usuariorol "; // Tabla de relaciones usuario-rol

    // Si se pasa un parámetro, añadir la cláusula WHERE
    if ($parametro != "") {
        $sql .= ' WHERE ' . $parametro;
    }

    // Iniciar la conexión a la base de datos
    if ($this->Iniciar()) {
        $res = $this->Ejecutar($sql); // Ejecutar la consulta
        
        // Verificar si la ejecución fue exitosa
        if ($res > -1) {  // Si la ejecución fue exitosa
            if ($res > 0) {
                // Iterar a través de los resultados de la consulta
                while ($row = $this->Registro()) {
                    $obj = new UsuarioRol(); // Crear un nuevo objeto UsuarioRol
                    $obj->setear($row['idusuario'], $row['idrol']); // Setear los valores de usuario y rol
                    array_push($arreglo, $obj); // Añadir el objeto al arreglo
                }
            }
        } else {
            // Si la consulta falló, establecer un mensaje de error
            $this->setMensajeOperacion("usuariorol->listar: " . $this->getError());
        }
    }
    
    return $arreglo; // Retornar el arreglo de objetos UsuarioRol
}


    

}
