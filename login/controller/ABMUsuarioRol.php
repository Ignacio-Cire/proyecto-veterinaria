<?php


class ABMUsuarioRol
{

    // Método para agregar un rol a un usuario
    public function agregar($idUsuario, $idRol)
    {
        $objUsuarioRol = new UsuarioRol();
        $objUsuarioRol->setear($idUsuario, $idRol);
        return $objUsuarioRol->insertar();
    }

    // Método para eliminar un rol de un usuario
    public function eliminar($idUsuario, $idRol)
    {
        $objUsuarioRol = new UsuarioRol();
        $objUsuarioRol->setear($idUsuario, $idRol);
        return $objUsuarioRol->eliminar();
    }

    // Método para obtener el rol de un usuario
    public function obtenerRol($idUsuario)
    {
        $objUsuarioRol = new UsuarioRol();
        $objUsuarioRol->setIdUsuario($idUsuario);
        if ($objUsuarioRol->seleccionar()) {
            return $objUsuarioRol->getIdRol();
        }
        return null;
    }

    // Método para listar todas las relaciones usuario-rol
    public function listar()
    {
        $lista = [];
        $sql = "SELECT * FROM usuariorol";
        $base = new BaseDatos();
        if ($base->Iniciar()) {
            $resultado = $base->Ejecutar($sql);
            if ($resultado) {
                while ($fila = $resultado->fetch_assoc()) {
                    $objUsuarioRol = new UsuarioRol();
                    $objUsuarioRol->setear($fila['idUsuario'], $fila['idRol']);
                    $lista[] = $objUsuarioRol;
                }
            }
        }
        return $lista;
    }
}
