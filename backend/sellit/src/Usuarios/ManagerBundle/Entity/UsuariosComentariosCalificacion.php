<?php

namespace Usuarios\ManagerBundle\Entity;

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
     * @var integer
     */
    private $idCalificacion;

    /**
     * @var string
     */
    private $comentario;


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
     * Set idCalificacion
     *
     * @param integer $idCalificacion
     * @return UsuariosComentariosCalificacion
     */
    public function setIdCalificacion($idCalificacion)
    {
        $this->idCalificacion = $idCalificacion;

        return $this;
    }

    /**
     * Get idCalificacion
     *
     * @return integer 
     */
    public function getIdCalificacion()
    {
        return $this->idCalificacion;
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
}
