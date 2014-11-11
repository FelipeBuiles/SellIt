<?php

namespace Productos\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductoOfertas
 */
class ProductoOfertas
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var float
     */
    private $oferta;

    /**
     * @var string
     */
    private $estadoOferta;

    /**
     * @var string
     */
    private $comentarios;

    /**
     * @var \Productos\ManagerBundle\Entity\Producto
     */
    private $idProducto;

    /**
     * @var \Productos\ManagerBundle\Entity\Usuarios
     */
    private $idUsuario;


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
     * Set oferta
     *
     * @param float $oferta
     * @return ProductoOfertas
     */
    public function setOferta($oferta)
    {
        $this->oferta = $oferta;

        return $this;
    }

    /**
     * Get oferta
     *
     * @return float 
     */
    public function getOferta()
    {
        return $this->oferta;
    }

    /**
     * Set estadoOferta
     *
     * @param string $estadoOferta
     * @return ProductoOfertas
     */
    public function setEstadoOferta($estadoOferta)
    {
        $this->estadoOferta = $estadoOferta;

        return $this;
    }

    /**
     * Get estadoOferta
     *
     * @return string 
     */
    public function getEstadoOferta()
    {
        return $this->estadoOferta;
    }

    /**
     * Set comentarios
     *
     * @param string $comentarios
     * @return ProductoOfertas
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;

        return $this;
    }

    /**
     * Get comentarios
     *
     * @return string 
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Set idProducto
     *
     * @param \Productos\ManagerBundle\Entity\Producto $idProducto
     * @return ProductoOfertas
     */
    public function setIdProducto(\Productos\ManagerBundle\Entity\Producto $idProducto = null)
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    /**
     * Get idProducto
     *
     * @return \Productos\ManagerBundle\Entity\Producto 
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Set idUsuario
     *
     * @param \Productos\ManagerBundle\Entity\Usuarios $idUsuario
     * @return ProductoOfertas
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
