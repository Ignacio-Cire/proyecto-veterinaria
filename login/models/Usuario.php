<?php

class Usuario extends BaseDatos
{
    private $id;
    private $nombreUsuario;
    private $email;
    private $password;
    private $usDeshabilitado; // Nuevo campo para saber si está deshabilitado
    private $mensajeOperacion;

    public function __construct($nombreUsuario = "", $email = "", $password = "", $usDeshabilitado = 0) {
        parent::__construct();
        $this->id = "";
        $this->nombreUsuario = $nombreUsuario;
        $this->email = $email;
        $this->password = $password;
        $this->usDeshabilitado = $usDeshabilitado; // Por defecto 0 (habilitado)
        $this->mensajeOperacion = "";
    }

    public function setear($id, $nombreUsuario, $password, $email, $usDeshabilitado)
    {
        $this->setId($id);
        $this->setNombreUsuario($nombreUsuario);
        $this->setPassword($password);
        $this->setEmail($email);
        $this->setUsDeshabilitado($usDeshabilitado);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($valor)
    {
        $this->id = $valor;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario($valor)
    {
        $this->nombreUsuario = $valor;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($valor)
    {
        $this->password = $valor;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($valor)
    {
        $this->email = $valor;
    }

    public function getUsDeshabilitado()
    {
        return $this->usDeshabilitado;
    }

    public function setUsDeshabilitado($valor)
    {
        $this->usDeshabilitado = $valor;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    public function setMensajeOperacion($valor)
    {
        $this->mensajeOperacion = $valor;
    }

    // Método para insertar un usuario en la base de datos
    public function insertar()
    {
        $resp = false;
        // Escapando los datos para prevenir inyección SQL
        $nombreUsuario = $this->getNombreUsuario();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $usDeshabilitado = $this->getUsDeshabilitado();

        $sql = "INSERT INTO usuarios (nombreUsuario, email, password, usDeshabilitado) VALUES ('" . $nombreUsuario . "', '" . $email . "', '" . $password . "', " . $usDeshabilitado . ")";
        
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($this->getError()); // Guardar el error si algo sale mal
            }
        } else {
            $this->setMensajeOperacion("No se pudo iniciar la conexión"); // Error al iniciar conexión
        }
        return $resp;
    }

    // Método para modificar un usuario
    public function modificar()
    {
        $resp = false;
        // Escapando los datos para prevenir inyección SQL
        $sql = "UPDATE usuarios SET nombreUsuario = '" . $this->getNombreUsuario() . "', password = '" . $this->getPassword() . "', email = '" . $this->getEmail() . "', usDeshabilitado = " . $this->getUsDeshabilitado() . " WHERE id = " . $this->getId();
        
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($this->getError()); // Guardar el error si algo sale mal
            }
        }
        return $resp;
    }

    // Método para eliminar un usuario
    public function eliminar()
    {
        $resp = false;
        // Escapando los datos para prevenir inyección SQL
        $sql = "DELETE FROM usuarios WHERE id = " . $this->getId();
        
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($this->getError()); // Guardar el error si algo sale mal
            }
        }
        return $resp;
    }

    // Método para obtener un mensaje de error, si ocurre
    public function getError()
    {
        return $this->mensajeOperacion;
    }

}

?>
