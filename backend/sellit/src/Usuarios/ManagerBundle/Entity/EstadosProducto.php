<?php

namespace Usuarios\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstadosProducto
 */
class EstadosProducto
{
    /**
     * @var string
     */
    private $estado;

    /**
     * @var boolean
     */
    private $cierraVenta;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set estado
     *
     * @param string $estado
     * @return EstadosProducto
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set cierraVenta
     *
     * @param boolean $cierraVenta
     * @return EstadosProducto
     */
    public function setCierraVenta($cierraVenta)
    {
        $this->cierraVenta = $cierraVenta;

        return $this;
    }

    /**
     * Get cierraVenta
     *
     * @return boolean 
     */
    public function getCierraVenta()
    {
        return $this->cierraVenta;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
