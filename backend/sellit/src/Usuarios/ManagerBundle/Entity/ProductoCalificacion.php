<?php

namespace Usuarios\ManagerBundle\Entity;

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
     * @var \Usuarios\ManagerBundle\Entity\Producto
     */
    private $idproducto;

    /**
     * @var \Usuarios\ManagerBundle\Entity\Usuarios
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
     * @param \Usuarios\ManagerBundle\Entity\Producto $idproducto
     * @return ProductoCalificacion
     */
    public function setIdproducto(\Usuarios\ManagerBundle\Entity\Producto $idproducto = null)
    {
        $this->idproducto = $idproducto;

        return $this;
    }

    /**
     * Get idproducto
     *
     * @return \Usuarios\ManagerBundle\Entity\Producto 
     */
    public function getIdproducto()
    {
        return $this->idproducto;
    }

    /**
     * Set idusuario
     *
     * @param \Usuarios\ManagerBundle\Entity\Usuarios $idusuario
     * @return ProductoCalificacion
     */
    public function setIdusuario(\Usuarios\ManagerBundle\Entity\Usuarios $idusuario = null)
    {
        $this->idusuario = $idusuario;

        return $this;
    }

    /**
     * Get idusuario
     *
     * @return \Usuarios\ManagerBundle\Entity\Usuarios 
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }
}
