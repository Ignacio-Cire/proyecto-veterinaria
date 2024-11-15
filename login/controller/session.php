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
    public function iniciar($email) {
        // Asumimos que hay una clase Usuario en el ORM que maneja la validación de usuarios

        //aca deberia llamar a ABMusuario...
        $usuario = new ABMUsuario();
        $usuarioEncontrado = $usuario->obtenerPorEmail($email);

        if ($usuarioEncontrado) {
            // Si el usuario es encontrado, actualizamos las variables de sesión
            $_SESSION['id'] = $usuario->getId();
            $_SESSION['nombreUsuario'] = $usuario->getNombreUsuario();

            // $_SESSION['rol'] = $usuario->getRol();  // Asumimos que el usuario tiene un rol
            return true;
        } else {
            return false;
        }
    }

    /**
     * Valida si la sesión actual tiene un usuario y contraseña válidos
     * @return bool
     */
    public function validar() {
        // se revisa si 'id' y 'usuario' existen y no están vacíos
        return isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_SESSION['usuario']) && !empty($_SESSION['usuario']);
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


