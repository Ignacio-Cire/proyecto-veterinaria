<?php

class abmCompraItem
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
            array_key_exists('idcompraitem', $param) &&
            array_key_exists('idproducto', $param) &&
            array_key_exists('idcompra', $param) &&
            array_key_exists('cicantidad', $param)
        ) {
            $obj = new compraItem();
            $producto = new producto();
            $compra = new compra();

            $producto->setID($param['idproducto']);
            $producto->cargar();
            $compra->setID($param['idcompra']);
            $compra->cargar();

            $obj->setear($param['idcompraitem'], $producto, $compra, $param['cicantidad']);
        }
        return $obj;
    }

    private function cargarObjetoSinID($param)
    {
        $obj = null;
        if (
            array_key_exists('idproducto', $param) &&
            array_key_exists('idcompra', $param) &&
            array_key_exists('cicantidad', $param)
        ) {
            $obj = new compraItem();
            $producto = new producto();
            $compra = new compra();

            $producto->setID($param['idproducto']);
            $producto->cargar();
            $compra->setID($param['idcompra']);
            $compra->cargar();

            $obj->setearSinID($producto, $compra, $param['cicantidad']);
        }
        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idcompraitem'])) {
            $obj = new compraItem();
            $obj->setear($param['idcompraitem'], null, null, null);
        }
        return $obj;
    }

    private function seteadosCamposClaves($param)
    {
        return isset($param['idcompraitem']);
    }

    public function alta($param)
    {
        $resp = false;
        $objcompra = $this->cargarObjeto($param);
        if ($objcompra != null && $objcompra->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    public function altaSinID($param)
    {
        $resp = false;
        $objProducto = $this->cargarObjetoSinID($param);
        if ($objProducto != null && $objProducto->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objcompra = $this->cargarObjetoConClave($param);
            if ($objcompra != null && $objcompra->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objcompra = $this->cargarObjeto($param);
            if ($objcompra != null && $objcompra->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param)
    {
        $where = " true ";
        if ($param !== null) {
            if (isset($param['idcompraitem'])) {
                $where .= " and idcompraitem ='" . $param['idcompraitem'] . "'";
            }
            if (isset($param['idproducto'])) {
                $where .= " and idproducto ='" . $param['idproducto'] . "'";
            }
            if (isset($param['idcompra'])) {
                $where .= " and idcompra ='" . $param['idcompra'] . "'";
            }
            if (isset($param['cicantidad'])) {
                $where .= " and cicantidad ='" . $param['cicantidad'] . "'";
            }
        }
        $objCI = new compraItem();
        return $objCI->listar($where);
    }

    public function modificarCantidad($idCompra)
    {
        $list = $this->buscar(['idcompra' => $idCompra]);
        foreach ($list as $objCI) {
            $nuevaCantidad = $objCI->getObjProducto()->getProCantStock() - $objCI->getCiCantidad();
            $objCI->getObjProducto()->setProCantStock($nuevaCantidad);
            $objCI->getObjProducto()->modificar();
        }
    }

    public function listarProductosPorCompra($datos)
    {
        $arreglo = [];
        $list = $this->buscar(['idcompra' => $datos['idcompra']]);
        if (count($list) > 0) {
            foreach ($list as $elem) {
                $nuevoElem = [
                    "pronombre" => $elem->getObjProducto()->getProNombre(),
                    "prodetalle" => $elem->getObjProducto()->getProDetalle(),
                    "precio" => $elem->getObjProducto()->getPrecio(),
                    "procantstock" => $elem->getCicantidad(),
                    "imagen" => $elem->getObjProducto()->getImagen()
                ];
                array_push($arreglo, $nuevoElem);
            }
        }
        return $arreglo;
    }
}
