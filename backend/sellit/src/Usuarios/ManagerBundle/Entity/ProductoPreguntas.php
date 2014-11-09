<?php

namespace Usuarios\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductoPreguntas
 */
class ProductoPreguntas
{
    /**
     * @var string
     */
    private $texto;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Usuarios\ManagerBundle\Entity\Usuarios
     */
    private $idUsuario;

    /**
     * @var \Usuarios\ManagerBundle\Entity\Producto
     */
    private $idProducto;

    /**
     * @var \Usuarios\ManagerBundle\Entity\ProductoPreguntas
     */
    private $idRespuestaPregunta;


    /**
     * Set texto
     *
     * @param string $texto
     * @return ProductoPreguntas
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return ProductoPreguntas
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return ProductoPreguntas
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
     * Set idUsuario
     *
     * @param \Usuarios\ManagerBundle\Entity\Usuarios $idUsuario
     * @return ProductoPreguntas
     */
    public function setIdUsuario(\Usuarios\ManagerBundle\Entity\Usuarios $idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \Usuarios\ManagerBundle\Entity\Usuarios 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set idProducto
     *
     * @param \Usuarios\ManagerBundle\Entity\Producto $idProducto
     * @return ProductoPreguntas
     */
    public function setIdProducto(\Usuarios\ManagerBundle\Entity\Producto $idProducto)
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    /**
     * Get idProducto
     *
     * @return \Usuarios\ManagerBundle\Entity\Producto 
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Set idRespuestaPregunta
     *
     * @param \Usuarios\ManagerBundle\Entity\ProductoPreguntas $idRespuestaPregunta
     * @return ProductoPreguntas
     */
    public function setIdRespuestaPregunta(\Usuarios\ManagerBundle\Entity\ProductoPreguntas $idRespuestaPregunta = null)
    {
        $this->idRespuestaPregunta = $idRespuestaPregunta;

        return $this;
    }

    /**
     * Get idRespuestaPregunta
     *
     * @return \Usuarios\ManagerBundle\Entity\ProductoPreguntas 
     */
    public function getIdRespuestaPregunta()
    {
        return $this->idRespuestaPregunta;
    }
}
