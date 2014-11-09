<?php

namespace Productos\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductoComentarios
 */
class ProductoComentarios
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $comentario;

    /**
     * @var \DateTime
     */
    private $fechaComentrio;

    /**
     * @var \Productos\ManagerBundle\Entity\Usuarios
     */
    private $idUsuario;

    /**
     * @var \Productos\ManagerBundle\Entity\Producto
     */
    private $idProducto;


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
     * Set comentario
     *
     * @param string $comentario
     * @return ProductoComentarios
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set fechaComentrio
     *
     * @param \DateTime $fechaComentrio
     * @return ProductoComentarios
     */
    public function setFechaComentrio($fechaComentrio)
    {
        $this->fechaComentrio = $fechaComentrio;

        return $this;
    }

    /**
     * Get fechaComentrio
     *
     * @return \DateTime 
     */
    public function getFechaComentrio()
    {
        return $this->fechaComentrio;
    }

    /**
     * Set idUsuario
     *
     * @param \Productos\ManagerBundle\Entity\Usuarios $idUsuario
     * @return ProductoComentarios
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

    /**
     * Set idProducto
     *
     * @param \Productos\ManagerBundle\Entity\Producto $idProducto
     * @return ProductoComentarios
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
}
