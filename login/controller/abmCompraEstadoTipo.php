<?php

class abmCompraEstadoTipo
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
     * Cargar un objeto de tipo compraestadotipo
     * @param array $param
     * @return compraestadotipo
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idcompraestadotipo', $param) &&
            array_key_exists('cetdescripcion', $param) &&
            array_key_exists('cetdetalle', $param)
        ) {
            $obj = new compraestadotipo();
            $obj->setIdCompraEstadoTipo($param['idcompraestadotipo']);
            $obj->setCetDescripcion($param['cetdescripcion']);
            $obj->setCetDetalle($param['cetdetalle']);
        }
        return $obj;
    }

    /**
     * Cargar objeto sin ID
     * @param array $param
     * @return compraestadotipo
     */
    private function cargarObjetoSinID($param)
    {
        $obj = null;
        if (
            array_key_exists('cetdescripcion', $param) &&
            array_key_exists('cetdetalle', $param)
        ) {
            $obj = new compraestadotipo();
            $obj->setCetDescripcion($param['cetdescripcion']);
            $obj->setCetDetalle($param['cetdetalle']);
        }
        return $obj;
    }

    /**
     * Cargar objeto con clave
     * @param array $param
     * @return compraestadotipo
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idcompraestadotipo'])) {
            $obj = new compraestadotipo();
            $obj->setIdCompraEstadoTipo($param['idcompraestadotipo']);
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
        return isset($param['idcompraestadotipo']);
    }

    /**
     * Alta de un objeto
     * @param array $param
     * @return boolean
     */
    public function alta($param)
    {
        $resp = false;
        $objCompraEstadoTipo = $this->cargarObjeto($param);
        if ($objCompraEstadoTipo != null && $objCompraEstadoTipo->insertar()) {
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
        $objCompraEstadoTipo = $this->cargarObjetoSinID($param);
        if ($objCompraEstadoTipo != null && $objCompraEstadoTipo->insertar()) {
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
            $objCompraEstadoTipo = $this->cargarObjetoConClave($param);
            if ($objCompraEstadoTipo != null && $objCompraEstadoTipo->eliminar()) {
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
            $objCompraEstadoTipo = $this->cargarObjeto($param);
            if ($objCompraEstadoTipo != null && $objCompraEstadoTipo->modificar()) {
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
            if (isset($param['idcompraestadotipo'])) {
                $where .= " and idcompraestadotipo ='" . $param['idcompraestadotipo'] . "'";
            }
            if (isset($param['cetdescripcion'])) {
                $where .= " and cetdescripcion ='" . $param['cetdescripcion'] . "'";
            }
            if (isset($param['cetdetalle'])) {
                $where .= " and cetdetalle ='" . $param['cetdetalle'] . "'";
            }
        }
        $objCE = new compraestadotipo();
        $arreglo = $objCE->listar($where);
        return $arreglo;
    }
}
?>
