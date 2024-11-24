<?php

class Carrito extends BaseDatos
{
    private $idCarrito;
    private $idusuario;
    private $fechaCreacion;
    private $idproducto;
    private $cantproductos;
    
    // Constructor
    public function __construct()
    {
        parent::__construct();
        $this->idCarrito = null;
        $this->idusuario = null;
        $this->fechaCreacion = null;
        $this->idproducto = null;
        $this->cantproductos = null;
    }

    // Setear valores (para inserciones y actualizaciones)
    public function setear($idusuario, $idproducto, $cantproductos, $fechaCreacion = null)
    {
        $this->idusuario = $idusuario;
        $this->idproducto = $idproducto;
        $this->cantproductos = $cantproductos;
        $this->fechaCreacion = $fechaCreacion ?: date('Y-m-d H:i:s');  // Fecha por defecto actual
    }

    // Getters y Setters
    public function getIdCarrito()
    {
        return $this->idCarrito;
    }

    public function setIdCarrito($valor)
    {
        $this->idCarrito = $valor;
    }

    public function getIdUsuario()
    {
        return $this->idusuario;
    }

    public function setIdUsuario($valor)
    {
        $this->idusuario = $valor;
    }

    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion($valor)
    {
        $this->fechaCreacion = $valor;
    }

    public function getIdProducto()
    {
        return $this->idproducto;
    }

    public function setIdProducto($valor)
    {
        $this->idproducto = $valor;
    }

    public function getCantProductos()
    {
        return $this->cantproductos;
    }

    public function setCantProductos($valor)
    {
        $this->cantproductos = $valor;
    }

    // Métodos de operaciones con la base de datos

    // Insertar un producto en el carrito de compras
    public function insertar()
    {
        $consulta = "INSERT INTO carrito (idusuario, idproducto, cantproductos, fechaCreacion) 
                    VALUES (?, ?, ?, ?)";
        $datos = array($this->idusuario, $this->idproducto, $this->cantproductos, $this->fechaCreacion);
        $this->iniciarTransaccion();
        if ($this->ejecutarConsulta($consulta, $datos)) {
            $this->commit();
            return true;
        } else {
            $this->rollBack();
            return false;
        }
    }

    // Obtener los productos en el carrito de un usuario
    public function obtenerCarritoPorUsuario($idusuario)
    {
        $consulta = "SELECT * FROM carrito WHERE idusuario = $idusuario";
        $datos = array($idusuario);
        $resultado = $this->ejecutarConsulta($consulta, $datos);
        return $resultado;
    }

    // Eliminar un producto del carrito
    public function eliminarProducto($idusuario, $idproducto)
    {
        $consulta = "DELETE FROM carrito WHERE idusuario = $idusuario AND idproducto = $idproducto";
        $datos = array($idusuario, $idproducto);
        $this->iniciarTransaccion();
        if ($this->ejecutarConsulta($consulta, $datos)) {
            $this->commit();
            return true;
        } else {
            $this->rollBack();
            return false;
        }
    }

    // Vaciar el carrito de un usuario
    public function vaciarCarrito($idusuario)
    {
        $consulta = "DELETE FROM carrito WHERE idusuario = $idusuario";
        $datos = array($idusuario);
        $this->iniciarTransaccion();
        if ($this->ejecutarConsulta($consulta, $datos)) {
            $this->commit();
            return true;
        } else {
            $this->rollBack();
            return false;
        }
    }

    // Obtener el total del carrito de un usuario (sumando los precios de los productos)
    public function obtenerTotalCarrito($idusuario)
    {
        $consulta = "SELECT SUM(p.precio * c.cantproductos) AS total 
                     FROM carrito c 
                     INNER JOIN productos p ON c.idproducto = p.idproducto 
                     WHERE c.idusuario = ?";
        $datos = array($idusuario);
        $resultado = $this->ejecutarConsulta($consulta, $datos);
        return $resultado ? $resultado[0]['total'] : 0;
    }
    
    // Obtener el mensaje de error
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }
}
?>
