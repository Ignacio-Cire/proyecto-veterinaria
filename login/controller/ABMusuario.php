<?php
class ABMUsuario
{

    public function abm($datos)
    {
        $resp = false;
        //print_r($datos);
        if ($datos['accion'] == 'editar') {
            if ($this->modificacion($datos)) {
                $resp = true;
            }
        }
        if ($datos['accion'] == 'borrar') {
            if ($this->baja($datos)) {
                $resp = true;
            }
        }
        if ($datos['accion'] == 'nuevo') {
            if ($this->alta($datos)) {
                $resp = true;
            }
        }
        if ($datos['accion'] == 'borrar_rol') {
            if ($this->borrar_rol($datos)) {
                $resp = true;
            }
        }
        if ($datos['accion'] == 'nuevo_rol') {
            if ($this->alta_rol($datos)) {
                $resp = true;
            }

        }
        return $resp;

    }
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Tabla
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        //SELECT `idusuario`, `usnombre`, `uspass`, `usmail`, `usdeshabilitado` FROM `usuario` WHERE 1
        print_r($param);
        echo "Cargue el objeto" . array_key_exists('id', $param) . " " . array_key_exists('nombreUsuario', $param) . " " . array_key_exists('password', $param) . " " . array_key_exists('email', $param);

        if (array_key_exists('id', $param) and array_key_exists('nombreUsuario', $param) and array_key_exists('password', $param)
            and array_key_exists('email', $param)) {
            echo "Cargue el dsdsdsd";
            $obj = new Usuario();
            $obj->setear($param['id'], $param['nombreUsuario'], $param['password'], $param['email'], null);
            echo "Cargue el objeto";
        }
        print_r($obj);
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Tabla
     */

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idusuario'])) {
            $obj = new Usuario();
            $obj->setear($param['idusuario'], null, null, null, null);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idusuario'])) {
            $resp = true;
        }

        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['id'] = null;
        $elObjtTabla = $this->cargarObjeto($param);
        if ($elObjtTabla != null && $elObjtTabla->insertar()) {
            $resp = true;
        } else {
            $elObjtTabla->getmensajeoperacion(); // Para depuración
        }
        return $resp;
    }

    public function borrar_rol($param)
    {
        $resp = false;
        if (isset($param['idusuario']) && isset($param['idrol'])) {
            $elObjtTabla = new UsuarioRol();
            $elObjtTabla->setearConClave($param['idusuario'], $param['idrol']);
            $resp = $elObjtTabla->eliminar();

        }

        return $resp;

    }


    public function alta_rol($param)
    {
        $resp = false;
        if (isset($param['idusuario']) && isset($param['idrol'])) {
            $elObjtTabla = new UsuarioRol();
            $elObjtTabla->setearConClave($param['idusuario'], $param['idrol']);
            $resp = $elObjtTabla->insertar();

        }

        return $resp;

    }


    /**
     * permite eliminar un objeto
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtTabla = $this->cargarObjetoConClave($param);
            if ($elObjtTabla != null and $elObjtTabla->eliminar()) {
                $resp = true;
            }
        }

        return $resp;
    }

    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */


    public function modificacion($param)
    {
        //echo "Estoy en modificacion";
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtTabla = $this->cargarObjeto($param);
            if ($elObjtTabla != null and $elObjtTabla->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function darRoles($param)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idusuario'])) {
                $where .= " and idusuario =" . $param['idusuario'];
            }

            if (isset($param['idrol'])) {
                $where .= " and idrol ='" . $param['idrol'] . "'";
            }

        }
        $obj = new UsuarioRol();
        $arreglo = $obj->listar($where);
        //echo "Van ".count($arreglo);
        return $arreglo;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['id'])) {
                $where .= " and id =" . $param['id'];
            }

            if (isset($param['nombreUsuario'])) {
                $where .= " and nombreUsuario ='" . $param['nombreUsuario'] . "'";
            }

            if (isset($param['email'])) {
                $where .= " and mail ='" . $param['email'] . "'";
            }

            if (isset($param['password'])) {
                $where .= " and password ='" . $param['password'] . "'";
            }

            if (isset($param['usDeshabilitado'])) {
                $where .= " and usDeshabilitado +='" . $param['usdeshabilitado'] . "'";
            }

        }
        $obj = new Usuario();
        $arreglo = $obj->listar($where);
        echo "Van " . count($arreglo);
        return $arreglo;
    }


    public function usuarioExiste($nombreUsuario, $email)
    {
        $respuesta = false;
        $list = $this->buscar(null);
        foreach ($list as $usActual) {
            if (($usActual->getusnombre() == $nombreUsuario) || ($usActual->getusmail() == $email)) {
                $respuesta = true;
            }
        }
        return $respuesta;
    }

    private function cargarObjetoSinID($param)
    {
        $obj = null;
        if (
            array_key_exists('nombreUsuario', $param) &&
            array_key_exists('password', $param) &&
            array_key_exists('email', $param) &&
            array_key_exists('usDeshabilitado', $param)
        ) {
            $obj = new usuario();
            $obj->setearSinID($param['nombreUsuario'], $param['password'], $param['email'], $param['usDeshabilitado']);
        }
        return $obj;
    }

    public function altaSinID($param)
    {
        $resp = false;

        $objUsuario = $this->cargarObjetoSinID($param);
        if ($objUsuario != null and $objUsuario->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    public function insertUser($data)
    {
        // Este método verifica si ya existe un usuario registrado con el nombre de usuario o correo electrónico proporcionados.
        $respuesta = false;
        if (!$this->usuarioExiste($data['nombreUsuario'], $data['email'])) {

            if ($this->altaSinID($data)) {
                $objUs = $this->buscar(['nombreUsuario' => $data['nombreUsuario'], 'email' => $data['email']]);
                $objUsRol = new ABMUsuarioRol();
                if (isset($data['idrol'])) {
                    $respuesta = $objUsRol->alta(['idrol' => $data['idrol'], 'idusuario' => $objUs[0]->getidusuario()]);
                } else {
                    $respuesta = $objUsRol->alta(['idrol' => 3, 'idusuario' => $objUs[0]->getID()]);
                }
            }
        }
        return $respuesta;
    }

    

   

}
