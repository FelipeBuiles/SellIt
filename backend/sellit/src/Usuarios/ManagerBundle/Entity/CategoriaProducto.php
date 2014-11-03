<?php

namespace Usuarios\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriaProducto
 */
class CategoriaProducto
{
    /**
     * @var string
     */
    private $categoria;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $idusuario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idusuario = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set categoria
     *
     * @param string $categoria
     * @return CategoriaProducto
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string 
     */
    public function getCategoria()
    {
        return $this->categoria;
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

    /**
     * Add idusuario
     *
     * @param \Usuarios\ManagerBundle\Entity\Usuarios $idusuario
     * @return CategoriaProducto
     */
    public function addIdusuario(\Usuarios\ManagerBundle\Entity\Usuarios $idusuario)
    {
        $this->idusuario[] = $idusuario;

        return $this;
    }

    /**
     * Remove idusuario
     *
     * @param \Usuarios\ManagerBundle\Entity\Usuarios $idusuario
     */
    public function removeIdusuario(\Usuarios\ManagerBundle\Entity\Usuarios $idusuario)
    {
        $this->idusuario->removeElement($idusuario);
    }

    /**
     * Get idusuario
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }
}
