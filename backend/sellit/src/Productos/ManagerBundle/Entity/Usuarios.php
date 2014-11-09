<?php

namespace Productos\ManagerBundle\Entity;

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
     * @var string
     */
    private $nombre;

    /**
     * @var \DateTime
     */
    private $fechaRegistro;


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
}
