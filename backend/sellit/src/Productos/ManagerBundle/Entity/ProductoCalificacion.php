<?php

namespace Productos\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductoCalificacion
 */
class ProductoCalificacion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $calificacion;

    /**
     * @var \Productos\ManagerBundle\Entity\Producto
     */
    private $idproducto;

    /**
     * @var \Productos\ManagerBundle\Entity\Usuarios
     */
    private $idusuario;


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
     * Set calificacion
     *
     * @param integer $calificacion
     * @return ProductoCalificacion
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;

        return $this;
    }

    /**
     * Get calificacion
     *
     * @return integer 
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Set idproducto
     *
     * @param \Productos\ManagerBundle\Entity\Producto $idproducto
     * @return ProductoCalificacion
     */
    public function setIdproducto(\Productos\ManagerBundle\Entity\Producto $idproducto = null)
    {
        $this->idproducto = $idproducto;

        return $this;
    }

    /**
     * Get idproducto
     *
     * @return \Productos\ManagerBundle\Entity\Producto 
     */
    public function getIdproducto()
    {
        return $this->idproducto;
    }

    /**
     * Set idusuario
     *
     * @param \Productos\ManagerBundle\Entity\Usuarios $idusuario
     * @return ProductoCalificacion
     */
    public function setIdusuario(\Productos\ManagerBundle\Entity\Usuarios $idusuario = null)
    {
        $this->idusuario = $idusuario;

        return $this;
    }

    /**
     * Get idusuario
     *
     * @return \Productos\ManagerBundle\Entity\Usuarios 
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }
}
