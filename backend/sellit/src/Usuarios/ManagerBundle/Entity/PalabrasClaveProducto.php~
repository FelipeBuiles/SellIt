<?php

namespace Usuarios\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PalabrasClaveProducto
 */
class PalabrasClaveProducto
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $palabra;

    /**
     * @var \Usuarios\ManagerBundle\Entity\Producto
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
     * Set palabra
     *
     * @param string $palabra
     * @return PalabrasClaveProducto
     */
    public function setPalabra($palabra)
    {
        $this->palabra = $palabra;

        return $this;
    }

    /**
     * Get palabra
     *
     * @return string 
     */
    public function getPalabra()
    {
        return $this->palabra;
    }

    /**
     * Set idProducto
     *
     * @param \Usuarios\ManagerBundle\Entity\Producto $idProducto
     * @return PalabrasClaveProducto
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
}
