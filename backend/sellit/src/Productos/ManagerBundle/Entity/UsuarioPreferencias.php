<?php

namespace Productos\ManagerBundle\Entity;

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
     * @var \Productos\ManagerBundle\Entity\CategoriaProducto
     */
    private $idcategoria;

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
     * Set idcategoria
     *
     * @param \Productos\ManagerBundle\Entity\CategoriaProducto $idcategoria
     * @return UsuarioPreferencias
     */
    public function setIdcategoria(\Productos\ManagerBundle\Entity\CategoriaProducto $idcategoria = null)
    {
        $this->idcategoria = $idcategoria;

        return $this;
    }

    /**
     * Get idcategoria
     *
     * @return \Productos\ManagerBundle\Entity\CategoriaProducto 
     */
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    /**
     * Set idusuario
     *
     * @param \Productos\ManagerBundle\Entity\Usuarios $idusuario
     * @return UsuarioPreferencias
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
