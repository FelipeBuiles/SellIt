<?php

namespace Usuarios\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Municipios
 */
class Municipios
{
    /**
     * @var integer
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
     * @var integer
     */
    private $id;

    /**
     * @var \Usuarios\ManagerBundle\Entity\Departamentos
     */
    private $idDepartamento;


    /**
     * Set idDane
     *
     * @param integer $idDane
     * @return Municipios
     */
    public function setIdDane($idDane)
    {
        $this->idDane = $idDane;

        return $this;
    }

    /**
     * Get idDane
     *
     * @return integer 
     */
    public function getIdDane()
    {
        return $this->idDane;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Municipios
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
     * @return Municipios
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
     * Set idDepartamento
     *
     * @param \Usuarios\ManagerBundle\Entity\Departamentos $idDepartamento
     * @return Municipios
     */
    public function setIdDepartamento(\Usuarios\ManagerBundle\Entity\Departamentos $idDepartamento = null)
    {
        $this->idDepartamento = $idDepartamento;

        return $this;
    }

    /**
     * Get idDepartamento
     *
     * @return \Usuarios\ManagerBundle\Entity\Departamentos 
     */
    public function getIdDepartamento()
    {
        return $this->idDepartamento;
    }
}
