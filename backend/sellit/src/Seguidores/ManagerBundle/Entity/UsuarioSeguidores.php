<?php

namespace Seguidores\ManagerBundle\Entity;

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
     * @var \Seguidores\ManagerBundle\Entity\Usuarios
     */
    private $idusuario;

    /**
     * @var \Seguidores\ManagerBundle\Entity\Usuarios
     */
    private $idseguido;


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
     * Set idusuario
     *
     * @param \Seguidores\ManagerBundle\Entity\Usuarios $idusuario
     * @return UsuarioSeguidores
     */
    public function setIdusuario(\Seguidores\ManagerBundle\Entity\Usuarios $idusuario = null)
    {
        $this->idusuario = $idusuario;

        return $this;
    }

    /**
     * Get idusuario
     *
     * @return \Seguidores\ManagerBundle\Entity\Usuarios 
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * Set idseguido
     *
     * @param \Seguidores\ManagerBundle\Entity\Usuarios $idseguido
     * @return UsuarioSeguidores
     */
    public function setIdseguido(\Seguidores\ManagerBundle\Entity\Usuarios $idseguido = null)
    {
        $this->idseguido = $idseguido;

        return $this;
    }

    /**
     * Get idseguido
     *
     * @return \Seguidores\ManagerBundle\Entity\Usuarios 
     */
    public function getIdseguido()
    {
        return $this->idseguido;
    }
}
