<?php

namespace Usuarios\ReputacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioCalificacion
 */
class UsuarioCalificacion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $calificacion;

    /**
     * @var string
     */
    private $comentario;

    /**
     * @var \Usuarios\ReputacionBundle\Entity\Usuarios
     */
    private $idUsuario;


    /**
     * Set id
     *
     * @param integer $id
     * @return UsuarioCalificacion
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
     * Set calificacion
     *
     * @param integer $calificacion
     * @return UsuarioCalificacion
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;

        return $this;
    }

    /**
     * Get calificacion
     *
     * @return integer 
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return UsuarioCalificacion
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set idUsuario
     *
     * @param \Usuarios\ReputacionBundle\Entity\Usuarios $idUsuario
     * @return UsuarioCalificacion
     */
    public function setIdUsuario(\Usuarios\ReputacionBundle\Entity\Usuarios $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \Usuarios\ReputacionBundle\Entity\Usuarios 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}
