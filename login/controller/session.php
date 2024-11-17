<?php

class Session {

    public function __construct() {
        // Inicia la sesión si no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Inicia la sesión con un usuario y contraseña
     * @param $nombreUsuario
     * @param $psw
     * @return bool
     */
    public function iniciar($nombreUsuario,$psw){
        $resp = false;
        $obj = new ABMUsuario();
        $param['nombreUsuario']=$nombreUsuario;
        $param['password']=$psw;
        $param['usdeshabilitado']='null';

        $resultado = $obj->buscar($param);
        if(count($resultado) > 0){
            $usuario = $resultado[0];
            $_SESSION['id']=$usuario->getidusuario();
            $resp = true;
        } else {
            $this->cerrar();
        }
        return $resp;
    }

    /**
     * Valida si la sesión actual tiene un usuario y contraseña válidos
     * @return bool
     */
    public function validar() {
        // se revisa si 'id' y 'usuario' existen y no están vacíos
        return isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_SESSION['nombreUsuario']) && !empty($_SESSION['nombreUsuario']);
    }
    
    /**
     * Verifica si la sesión está activa
     * @return bool
     */
    public function activa() {
        return session_status() == PHP_SESSION_ACTIVE;
    }

    /**
     * Devuelve el usuario logeado
     * @return mixed
     */
    public function getUsuario() {
        if (isset($_SESSION['nombreUsuario'])) {
            return $_SESSION['nombreUsuario'];
        }
        return null; // Si no está definido, devuelve null
    }
    
    
    /**
     * Devuelve el rol del usuario logeado
     * @return mixed
     */
    public function getRol() {
        if ($this->validar()) {
            return $_SESSION['rol'];
        }
        return null;
    }

    /**
     * Cierra la sesión actual
     */
    public function cerrar() {
        // Limpiar todas las variables de sesión
        $_SESSION = array();

        // Destruir la sesión
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }

    
}


