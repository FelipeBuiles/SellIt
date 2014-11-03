<?php

namespace Usuarios\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuarios
 */
class Usuarios
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $idFront;


    /**
     * Set id
     *
     * @param integer $id
     * @return Usuarios
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
     * Set idFront
     *
     * @param integer $idFront
     * @return Usuarios
     */
    public function setIdFront($idFront)
    {
        $this->idFront = $idFront;

        return $this;
    }

    /**
     * Get idFront
     *
     * @return integer 
     */
    public function getIdFront()
    {
        return $this->idFront;
    }
    /**
     * @var string
     */
    private $nombre;

    /**
     * @var \DateTime
     */
    private $fechaRegistro;


    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Usuarios
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
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return Usuarios
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime 
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }
    /**
     * @var string
     */
    private $rutaAvatar;


    /**
     * Set rutaAvatar
     *
     * @param string $rutaAvatar
     * @return Usuarios
     */
    public function setRutaAvatar($rutaAvatar)
    {
        $this->rutaAvatar = $rutaAvatar;

        return $this;
    }

    /**
     * Get rutaAvatar
     *
     * @return string 
     */
    public function getRutaAvatar()
    {
        return $this->rutaAvatar;
    }
    /**
     * @var float
     */
    private $latitud;

    /**
     * @var float
     */
    private $longitud;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $idcategoria;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idcategoria = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set latitud
     *
     * @param float $latitud
     * @return Usuarios
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;

        return $this;
    }

    /**
     * Get latitud
     *
     * @return float 
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set longitud
     *
     * @param float $longitud
     * @return Usuarios
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;

        return $this;
    }

    /**
     * Get longitud
     *
     * @return float 
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Add idcategoria
     *
     * @param \Usuarios\ManagerBundle\Entity\CategoriaProducto $idcategoria
     * @return Usuarios
     */
    public function addIdcategorium(\Usuarios\ManagerBundle\Entity\CategoriaProducto $idcategoria)
    {
        $this->idcategoria[] = $idcategoria;

        return $this;
    }

    /**
     * Remove idcategoria
     *
     * @param \Usuarios\ManagerBundle\Entity\CategoriaProducto $idcategoria
     */
    public function removeIdcategorium(\Usuarios\ManagerBundle\Entity\CategoriaProducto $idcategoria)
    {
        $this->idcategoria->removeElement($idcategoria);
    }

    /**
     * Get idcategoria
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }
}
