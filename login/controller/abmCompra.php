<?php

class abmCompra
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

    /**
     * Cargar un objeto de tipo Compra
     * @param array $param
     * @return Compra
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idcompra', $param) &&
            array_key_exists('coFecha', $param) &&
            array_key_exists('idusuario', $param)
        ) {
            $obj = new Compra();
            $obj->setIdCompra($param['idcompra']);
            $obj->setCoFecha($param['coFecha']);
            $obj->setIdUsuario($param['idusuario']);
        }
        return $obj;
    }

    /**
     * Cargar objeto sin ID
     * @param array $param
     * @return Compra
     */
    private function cargarObjetoSinID($param)
    {
        $obj = null;
        if (
            array_key_exists('coFecha', $param) &&
            array_key_exists('idusuario', $param)
        ) {
            $obj = new Compra();
            $obj->setCoFecha($param['coFecha']);
            $obj->setIdUsuario($param['idusuario']);
        }
        return $obj;
    }

    /**
     * Cargar objeto con clave
     * @param array $param
     * @return Compra
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idcompra'])) {
            $obj = new Compra();
            $obj->setIdCompra($param['idcompra']);
        }
        return $obj;
    }

    /**
     * Corroborar si los campos clave están seteados
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param)
    {
        return isset($param['idcompra']);
    }

    /**
     * Alta de un objeto
     * @param array $param
     * @return boolean
     */
    public function alta($param)
    {
        $resp = false;
        $objCompra = $this->cargarObjeto($param);
        if ($objCompra != null && $objCompra->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Alta de un objeto sin ID
     * @param array $param
     * @return boolean
     */
    public function altaSinID($param)
    {
        $resp = false;
        $objCompra = $this->cargarObjetoSinID($param);
        if ($objCompra != null && $objCompra->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Baja de un objeto
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objCompra = $this->cargarObjetoConClave($param);
            if ($objCompra != null && $objCompra->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Modificación de un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objCompra = $this->cargarObjeto($param);
            if ($objCompra != null && $objCompra->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idcompra'])) {
                $where .= " and idcompra ='" . $param['idcompra'] . "'";
            }
            if (isset($param['coFecha'])) {
                $where .= " and coFecha ='" . $param['coFecha'] . "'";
            }
            if (isset($param['idusuario'])) {
                $where .= " and idusuario ='" . $param['idusuario'] . "'";
            }
        }
        $objCompra = new Compra();
        $arreglo = $objCompra->listar($where);
        return $arreglo;
    }
}
?>
