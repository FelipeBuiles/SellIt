<?php

namespace Productos\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioSeguidores
 */
class UsuarioSeguidores
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Productos\ManagerBundle\Entity\Usuarios
     */
    private $idseguido;

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
     * Set idseguido
     *
     * @param \Productos\ManagerBundle\Entity\Usuarios $idseguido
     * @return UsuarioSeguidores
     */
    public function setIdseguido(\Productos\ManagerBundle\Entity\Usuarios $idseguido = null)
    {
        $this->idseguido = $idseguido;

        return $this;
    }

    /**
     * Get idseguido
     *
     * @return \Productos\ManagerBundle\Entity\Usuarios 
     */
    public function getIdseguido()
    {
        return $this->idseguido;
    }

    /**
     * Set idusuario
     *
     * @param \Productos\ManagerBundle\Entity\Usuarios $idusuario
     * @return UsuarioSeguidores
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
