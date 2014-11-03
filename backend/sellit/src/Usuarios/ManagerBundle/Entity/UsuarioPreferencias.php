<?php

namespace Usuarios\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioPreferencias
 */
class UsuarioPreferencias
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Usuarios\ManagerBundle\Entity\CategoriaProducto
     */
    private $idcategoria;

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
     * Set idcategoria
     *
     * @param \Usuarios\ManagerBundle\Entity\CategoriaProducto $idcategoria
     * @return UsuarioPreferencias
     */
    public function setIdcategoria(\Usuarios\ManagerBundle\Entity\CategoriaProducto $idcategoria = null)
    {
        $this->idcategoria = $idcategoria;

        return $this;
    }

    /**
     * Get idcategoria
     *
     * @return \Usuarios\ManagerBundle\Entity\CategoriaProducto 
     */
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    /**
     * Set idusuario
     *
     * @param \Usuarios\ManagerBundle\Entity\Usuarios $idusuario
     * @return UsuarioPreferencias
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
