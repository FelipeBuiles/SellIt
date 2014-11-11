<?php

namespace Productos\ManagerBundle\Entity;

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
     * @var \Productos\ManagerBundle\Entity\UsuarioMetas
     */
    private $idmeta;

    /**
     * @var \Productos\ManagerBundle\Entity\Usuarios
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
     * @param \Productos\ManagerBundle\Entity\UsuarioMetas $idmeta
     * @return SeguidoresMeta
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

    /**
     * Set idseguidor
     *
     * @param \Productos\ManagerBundle\Entity\Usuarios $idseguidor
     * @return SeguidoresMeta
     */
    public function setIdseguidor(\Productos\ManagerBundle\Entity\Usuarios $idseguidor = null)
    {
        $this->idseguidor = $idseguidor;

        return $this;
    }

    /**
     * Get idseguidor
     *
     * @return \Productos\ManagerBundle\Entity\Usuarios 
     */
    public function getIdseguidor()
    {
        return $this->idseguidor;
    }
}
