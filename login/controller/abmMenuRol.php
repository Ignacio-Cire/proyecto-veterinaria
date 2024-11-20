
<?php
class abmMenuRol
{
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

    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idmenurol', $param) &&
            array_key_exists('idrol', $param) &&
            array_key_exists('idmenu', $param)
        ) {
            $obj = new menuRol();
            $obj->setear($param['idmenurol'], $param['idrol'], $param['idmenu']);
        }
        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $objMenuRol = null;
        if (isset($param['idmenurol'])) {
            $objMenuRol = new menuRol();
            $objMenuRol->setear($param['idmenurol'], null, null);
        }
        return $objMenuRol;
    }

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idmenurol'])) {
            $resp = true;
        }
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $objMenuRol = $this->cargarObjeto($param);
        if ($objMenuRol != null && $objMenuRol->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objMenuRol = $this->cargarObjetoConClave($param);
            if ($objMenuRol != null && $objMenuRol->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objMenuRol = $this->cargarObjeto($param);
            if ($objMenuRol != null && $objMenuRol->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param)
    {
        $where = " true ";
        if ($param <> null) {
            if (isset($param['idmenurol'])) {
                $where .= " and idmenurol ='" . $param['idmenurol'] . "'";
            }
            if (isset($param['idrol'])) {
                $where .= " and idrol ='" . $param['idrol'] . "'";
            }
            if (isset($param['idmenu'])) {
                $where .= " and idmenu ='" . $param['idmenu'] . "'";
            }
        }

        $objMenuRol = new menuRol();
        $arreglo = $objMenuRol->listar($where);
        return $arreglo;
    }

    public function listarMenuRol()
    {
        $arreglo = [];
        $list = $this->buscar(null); // buscar sin parámetros
        if (count($list) > 0) {
            foreach ($list as $elem) {
                $nuevoElem = [
                    "idmenurol" => $elem->getID(),
                    "idrol" => $elem->getIdRol(),
                    "idmenu" => $elem->getIdMenu()
                ];
                array_push($arreglo, $nuevoElem);
            }
        }

        return $arreglo;
    }
}
