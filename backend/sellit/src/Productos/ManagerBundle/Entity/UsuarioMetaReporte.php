<?php

namespace Productos\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioMetaReporte
 */
class UsuarioMetaReporte
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $avanceDinero;

    /**
     * @var \Productos\ManagerBundle\Entity\UsuarioMetas
     */
    private $idmeta;


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
     * Set avanceDinero
     *
     * @param integer $avanceDinero
     * @return UsuarioMetaReporte
     */
    public function setAvanceDinero($avanceDinero)
    {
        $this->avanceDinero = $avanceDinero;

        return $this;
    }

    /**
     * Get avanceDinero
     *
     * @return integer 
     */
    public function getAvanceDinero()
    {
        return $this->avanceDinero;
    }

    /**
     * Set idmeta
     *
     * @param \Productos\ManagerBundle\Entity\UsuarioMetas $idmeta
     * @return UsuarioMetaReporte
     */
    public function setIdmeta(\Productos\ManagerBundle\Entity\UsuarioMetas $idmeta = null)
    {
        $this->idmeta = $idmeta;

        return $this;
    }

    /**
     * Get idmeta
     *
     * @return \Productos\ManagerBundle\Entity\UsuarioMetas 
     */
    public function getIdmeta()
    {
        return $this->idmeta;
    }
}
