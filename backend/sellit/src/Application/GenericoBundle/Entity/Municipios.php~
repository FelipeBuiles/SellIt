<?php

namespace Application\GenericoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Municipios
 */
class Municipios
{
    /**
     * @var integer
     */
    private $id;

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
     * @var \Application\GenericoBundle\Entity\Departamentos
     */
    private $idDepartamento;


    /**
     * Set id
     *
     * @param integer $id
     * @return Municipios
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set idDepartamento
     *
     * @param \Application\GenericoBundle\Entity\Departamentos $idDepartamento
     * @return Municipios
     */
    public function setIdDepartamento(\Application\GenericoBundle\Entity\Departamentos $idDepartamento = null)
    {
        $this->idDepartamento = $idDepartamento;

        return $this;
    }

    /**
     * Get idDepartamento
     *
     * @return \Application\GenericoBundle\Entity\Departamentos 
     */
    public function getIdDepartamento()
    {
        return $this->idDepartamento;
    }
}
