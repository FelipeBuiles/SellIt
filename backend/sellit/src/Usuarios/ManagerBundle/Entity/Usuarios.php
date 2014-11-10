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
     * @var string
     */
    private $idFront;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var \DateTime
     */
    private $fechaRegistro;

    /**
     * @var string
     */
    private $rutaAvatar;

    /**
     * @var float
     */
    private $latitud;

    /**
     * @var float
     */
    private $longitud;


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
     * @param string $idFront
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
     * @return string 
     */
    public function getIdFront()
    {
        return $this->idFront;
    }

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
}
