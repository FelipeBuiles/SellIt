<?php

namespace Productos\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioMetas
 */
class UsuarioMetas
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $montoMeta;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $estado;

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
     * Set montoMeta
     *
     * @param integer $montoMeta
     * @return UsuarioMetas
     */
    public function setMontoMeta($montoMeta)
    {
        $this->montoMeta = $montoMeta;

        return $this;
    }

    /**
     * Get montoMeta
     *
     * @return integer 
     */
    public function getMontoMeta()
    {
        return $this->montoMeta;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return UsuarioMetas
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
     * Set estado
     *
     * @param string $estado
     * @return UsuarioMetas
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
     * Set idusuario
     *
     * @param \Productos\ManagerBundle\Entity\Usuarios $idusuario
     * @return UsuarioMetas
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
