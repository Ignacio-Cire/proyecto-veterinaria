<?php

class abmCompraEstado
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
     * Cargar un objeto de tipo CompraEstado
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idcompraestado', $param) &&
            array_key_exists('idcompra', $param) &&
            array_key_exists('idcompraestadotipo', $param) &&
            array_key_exists('cefechaini', $param) &&
            array_key_exists('cefechafin', $param)
        ) {
            $obj = new CompraEstado();
            $obj->setIdCompraEstado($param['idcompraestado']);
            $obj->setIdCompra($param['idcompra']);
            $obj->setIdCompraEstadoTipo($param['idcompraestadotipo']);
            $obj->setCeFechaIni($param['cefechaini']);
            $obj->setCeFechaFin($param['cefechafin']);
        }
        return $obj;
    }

    /**
     * Cargar objeto sin ID
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjetoSinID($param)
    {
        $obj = null;
        if (
            array_key_exists('idcompra', $param) &&
            array_key_exists('idcompraestadotipo', $param) &&
            array_key_exists('cefechaini', $param) &&
            array_key_exists('cefechafin', $param)
        ) {
            $obj = new CompraEstado();
            $obj->setIdCompra($param['idcompra']);
            $obj->setIdCompraEstadoTipo($param['idcompraestadotipo']);
            $obj->setCeFechaIni($param['cefechaini']);
            $obj->setCeFechaFin($param['cefechafin']);
        }
        return $obj;
    }

    /**
     * Cargar objeto con clave
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idcompraestado'])) {
            $obj = new CompraEstado();
            $obj->setIdCompraEstado($param['idcompraestado']);
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
        return isset($param['idcompraestado']);
    }

    /**
     * Alta de un objeto
     * @param array $param
     * @return boolean
     */
    public function alta($param)
    {
        $resp = false;
        $objCompraEstado = $this->cargarObjeto($param);
        if ($objCompraEstado != null && $objCompraEstado->insertar()) {
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
        $objCompraEstado = $this->cargarObjetoSinID($param);
        if ($objCompraEstado != null && $objCompraEstado->insertar()) {
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
            $objCompraEstado = $this->cargarObjetoConClave($param);
            if ($objCompraEstado != null && $objCompraEstado->eliminar()) {
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
            $objCompraEstado = $this->cargarObjeto($param);
            if ($objCompraEstado != null && $objCompraEstado->modificar()) {
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
            if (isset($param['idcompraestado'])) {
                $where .= " and idcompraestado ='" . $param['idcompraestado'] . "'";
            }
            if (isset($param['idcompra'])) {
                $where .= " and idcompra ='" . $param['idcompra'] . "'";
            }
            if (isset($param['idcompraestadotipo'])) {
                $where .= " and idcompraestadotipo ='" . $param['idcompraestadotipo'] . "'";
            }
            if (isset($param['cefechaini'])) {
                $where .= " and cefechaini ='" . $param['cefechaini'] . "'";
            }
            if (isset($param['cefechafin'])) {
                $where .= " and cefechafin ='" . $param['cefechafin'] . "'";
            }
        }
        $objCE = new CompraEstado();
        $arreglo = $objCE->listar($where);
        return $arreglo;
    }
}
?>
