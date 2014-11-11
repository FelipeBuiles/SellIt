<?php

namespace Productos\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departamentos
 */
class Departamentos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $idDane;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var boolean
     */
    private $activo;


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
     * Set idDane
     *
     * @param string $idDane
     * @return Departamentos
     */
    public function setIdDane($idDane)
    {
        $this->idDane = $idDane;

        return $this;
    }

    /**
     * Get idDane
     *
     * @return string 
     */
    public function getIdDane()
    {
        return $this->idDane;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Departamentos
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Departamentos
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }
}
