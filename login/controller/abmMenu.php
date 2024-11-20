<?php

class abmMenu
{
    // Función principal que maneja las acciones
    public function abm($datos)
    {
        $resp = false;
        if ($datos['action'] == 'eliminar') {
            if ($this->baja($datos)) {
                $resp = true;
            }
        }
        if ($datos['action'] == 'modificar') {
            if ($this->modificacion($datos)) {
                $resp = true;
            }
        }
        if ($datos['action'] == 'alta') {
            if ($this->alta($datos)) {
                $resp = true;
            }
        }
        return $resp;
    }

    // Crear un objeto de tipo Menu
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idmenu', $param) &&
            array_key_exists('nombre', $param) &&
            array_key_exists('descripcion', $param) &&
            array_key_exists('idpadre', $param) &&
            array_key_exists('deshabilitado', $param)
        ) {
            $obj = new Menu();
            $obj->setear($param['idmenu'], $param['nombre'], $param['descripcion'], $param['idpadre'], $param['deshabilitado']);
        }
        return $obj;
    }

    // Cargar objeto con clave primaria (para modificación o eliminación)
    private function cargarObjetoConClave($param)
    {
        $objMenu = null;
        if (isset($param['idmenu'])) {
            $objMenu = new Menu();
            $objMenu->setear($param['idmenu'], null, null, null, null);
        }
        return $objMenu;
    }

    // Verificar si los campos clave están seteados
    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idmenu'])) {
            $resp = true;
        }
        return $resp;
    }

    // Alta (Insertar) un nuevo menú
    public function alta($param)
    {
        $resp = false;
        $objMenu = $this->cargarObjeto($param);
        if ($objMenu != null && $objMenu->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    // Baja (Eliminar) un menú
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objMenu = $this->cargarObjetoConClave($param);
            if ($objMenu != null && $objMenu->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    // Modificación de un menú
    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objMenu = $this->cargarObjeto($param);
            if ($objMenu != null && $objMenu->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    // Buscar menús según parámetros
    public function buscar($param)
    {
        $where = " true ";
        if ($param <> null) {
            if (isset($param['idmenu'])) {
                $where .= " and idmenu ='" . $param['idmenu'] . "'";
            }
            if (isset($param['nombre'])) {
                $where .= " and menombre ='" . $param['nombre'] . "'";
            }
            if (isset($param['idpadre'])) {
                $where .= " and idpadre ='" . $param['idpadre'] . "'";
            }
            if (isset($param['deshabilitado'])) {
                $where .= " and medeshabilitado ='" . $param['deshabilitado'] . "'";
            }
        }

        $objMenu = new Menu();
        $arreglo = $objMenu->listar($where);
        return $arreglo;
    }

    // Listar todos los menús
    public function listarMenu()
    {
        $arreglo = [];
        $list = $this->buscar(null); // buscar sin parámetros
        if (count($list) > 0) {
            foreach ($list as $elem) {
                $nuevoElem = [
                    "idmenu" => $elem->getIdMenu(),
                    "nombre" => $elem->getNombre(),
                    "descripcion" => $elem->getDescripcion(),
                    "idpadre" => $elem->getIdPadre(),
                    "deshabilitado" => $elem->getDeshabilitado()
                ];
                array_push($arreglo, $nuevoElem);
            }
        }

        return $arreglo;
    }
}
