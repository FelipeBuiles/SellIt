<?php

namespace Productos\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductoPreguntas
 */
class ProductoPreguntas
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $texto;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var \Productos\ManagerBundle\Entity\Usuarios
     */
    private $idUsuario;

    /**
     * @var \Productos\ManagerBundle\Entity\Producto
     */
    private $idProducto;

    /**
     * @var \Productos\ManagerBundle\Entity\ProductoPreguntas
     */
    private $idRespuestaPregunta;


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
     * Set idUsuario
     *
     * @param \Productos\ManagerBundle\Entity\Usuarios $idUsuario
     * @return ProductoPreguntas
     */
    public function setIdUsuario(\Productos\ManagerBundle\Entity\Usuarios $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \Productos\ManagerBundle\Entity\Usuarios 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set idProducto
     *
     * @param \Productos\ManagerBundle\Entity\Producto $idProducto
     * @return ProductoPreguntas
     */
    public function setIdProducto(\Productos\ManagerBundle\Entity\Producto $idProducto = null)
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    /**
     * Get idProducto
     *
     * @return \Productos\ManagerBundle\Entity\Producto 
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Set idRespuestaPregunta
     *
     * @param \Productos\ManagerBundle\Entity\ProductoPreguntas $idRespuestaPregunta
     * @return ProductoPreguntas
     */
    public function setIdRespuestaPregunta(\Productos\ManagerBundle\Entity\ProductoPreguntas $idRespuestaPregunta = null)
    {
        $this->idRespuestaPregunta = $idRespuestaPregunta;

        return $this;
    }

    /**
     * Get idRespuestaPregunta
     *
     * @return \Productos\ManagerBundle\Entity\ProductoPreguntas 
     */
    public function getIdRespuestaPregunta()
    {
        return $this->idRespuestaPregunta;
    }
}
