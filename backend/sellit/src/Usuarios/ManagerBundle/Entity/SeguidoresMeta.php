<?php

namespace Usuarios\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SeguidoresMeta
 */
class SeguidoresMeta
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Usuarios\ManagerBundle\Entity\UsuarioMetas
     */
    private $idmeta;

    /**
     * @var \Usuarios\ManagerBundle\Entity\Usuarios
     */
    private $idseguidor;


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
     * Set idmeta
     *
     * @param \Usuarios\ManagerBundle\Entity\UsuarioMetas $idmeta
     * @return SeguidoresMeta
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

    /**
     * Set idseguidor
     *
     * @param \Usuarios\ManagerBundle\Entity\Usuarios $idseguidor
     * @return SeguidoresMeta
     */
    public function setIdseguidor(\Usuarios\ManagerBundle\Entity\Usuarios $idseguidor = null)
    {
        $this->idseguidor = $idseguidor;

        return $this;
    }

    /**
     * Get idseguidor
     *
     * @return \Usuarios\ManagerBundle\Entity\Usuarios 
     */
    public function getIdseguidor()
    {
        return $this->idseguidor;
    }
}
