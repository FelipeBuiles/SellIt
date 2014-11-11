<?php

namespace Usuarios\ManagerBundle\Entity;

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
     * @var \Usuarios\ManagerBundle\Entity\UsuarioMetas
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
     * @param \Usuarios\ManagerBundle\Entity\UsuarioMetas $idmeta
     * @return UsuarioMetaReporte
     */
    public function setIdmeta(\Usuarios\ManagerBundle\Entity\UsuarioMetas $idmeta = null)
    {
        $this->idmeta = $idmeta;

        return $this;
    }

    /**
     * Get idmeta
     *
     * @return \Usuarios\ManagerBundle\Entity\UsuarioMetas 
     */
    public function getIdmeta()
    {
        return $this->idmeta;
    }
}
