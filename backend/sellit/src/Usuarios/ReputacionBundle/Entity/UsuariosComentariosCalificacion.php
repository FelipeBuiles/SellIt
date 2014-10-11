<?php

namespace Usuarios\ReputacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuariosComentariosCalificacion
 */
class UsuariosComentariosCalificacion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $comentario;

    /**
     * @var \Usuarios\ReputacionBundle\Entity\UsuarioCalificacion
     */
    private $idCalificacion;


    /**
     * Set id
     *
     * @param integer $id
     * @return UsuariosComentariosCalificacion
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
     * Set comentario
     *
     * @param string $comentario
     * @return UsuariosComentariosCalificacion
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
     * Set idCalificacion
     *
     * @param \Usuarios\ReputacionBundle\Entity\UsuarioCalificacion $idCalificacion
     * @return UsuariosComentariosCalificacion
     */
    public function setIdCalificacion(\Usuarios\ReputacionBundle\Entity\UsuarioCalificacion $idCalificacion = null)
    {
        $this->idCalificacion = $idCalificacion;

        return $this;
    }

    /**
     * Get idCalificacion
     *
     * @return \Usuarios\ReputacionBundle\Entity\UsuarioCalificacion 
     */
    public function getIdCalificacion()
    {
        return $this->idCalificacion;
    }
}
