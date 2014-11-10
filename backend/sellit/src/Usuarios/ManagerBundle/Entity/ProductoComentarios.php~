<?php

namespace Usuarios\ManagerBundle\Entity;

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
     * @var \Usuarios\ManagerBundle\Entity\Producto
     */
    private $idProducto;

    /**
     * @var \Usuarios\ManagerBundle\Entity\Usuarios
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
     * Set idProducto
     *
     * @param \Usuarios\ManagerBundle\Entity\Producto $idProducto
     * @return ProductoComentarios
     */
    public function setIdProducto(\Usuarios\ManagerBundle\Entity\Producto $idProducto = null)
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    /**
     * Get idProducto
     *
     * @return \Usuarios\ManagerBundle\Entity\Producto 
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Set idUsuario
     *
     * @param \Usuarios\ManagerBundle\Entity\Usuarios $idUsuario
     * @return ProductoComentarios
     */
    public function setIdUsuario(\Usuarios\ManagerBundle\Entity\Usuarios $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \Usuarios\ManagerBundle\Entity\Usuarios 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}
