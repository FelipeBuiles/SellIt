<?php

namespace Productos\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Producto
 */
class Producto
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var float
     */
    private $precio;

    /**
     * @var boolean
     */
    private $activo;

    /**
     * @var \DateTime
     */
    private $fechaPublicacion;

    /**
     * @var \Productos\ManagerBundle\Entity\CategoriaProducto
     */
    private $idCategoria;

    /**
     * @var \Productos\ManagerBundle\Entity\EstadosProducto
     */
    private $idEstado;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Producto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Producto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return Producto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Producto
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set fechaPublicacion
     *
     * @param \DateTime $fechaPublicacion
     * @return Producto
     */
    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;

        return $this;
    }

    /**
     * Get fechaPublicacion
     *
     * @return \DateTime 
     */
    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }

    /**
     * Set idCategoria
     *
     * @param \Productos\ManagerBundle\Entity\CategoriaProducto $idCategoria
     * @return Producto
     */
    public function setIdCategoria(\Productos\ManagerBundle\Entity\CategoriaProducto $idCategoria = null)
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }

    /**
     * Get idCategoria
     *
     * @return \Productos\ManagerBundle\Entity\CategoriaProducto 
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    /**
     * Set idEstado
     *
     * @param \Productos\ManagerBundle\Entity\EstadosProducto $idEstado
     * @return Producto
     */
    public function setIdEstado(\Productos\ManagerBundle\Entity\EstadosProducto $idEstado = null)
    {
        $this->idEstado = $idEstado;

        return $this;
    }

    /**
     * Get idEstado
     *
     * @return \Productos\ManagerBundle\Entity\EstadosProducto 
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }
    /**
     * @var \Productos\ManagerBundle\Entity\Usuarios
     */
    private $idUsuario;


    /**
     * Set idUsuario
     *
     * @param \Productos\ManagerBundle\Entity\Usuarios $idUsuario
     * @return Producto
     */
    public function setIdUsuario(\Productos\ManagerBundle\Entity\Usuarios $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \Productos\ManagerBundle\Entity\Usuarios 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}
