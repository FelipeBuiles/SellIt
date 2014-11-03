<?php

namespace Usuarios\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductoImagenes
 */
class ProductoImagenes
{
    /**
     * @var string
     */
    private $rutaImagen;

    /**
     * @var string
     */
    private $nombreImagen;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Usuarios\ManagerBundle\Entity\Producto
     */
    private $idProducto;


    /**
     * Set rutaImagen
     *
     * @param string $rutaImagen
     * @return ProductoImagenes
     */
    public function setRutaImagen($rutaImagen)
    {
        $this->rutaImagen = $rutaImagen;

        return $this;
    }

    /**
     * Get rutaImagen
     *
     * @return string 
     */
    public function getRutaImagen()
    {
        return $this->rutaImagen;
    }

    /**
     * Set nombreImagen
     *
     * @param string $nombreImagen
     * @return ProductoImagenes
     */
    public function setNombreImagen($nombreImagen)
    {
        $this->nombreImagen = $nombreImagen;

        return $this;
    }

    /**
     * Get nombreImagen
     *
     * @return string 
     */
    public function getNombreImagen()
    {
        return $this->nombreImagen;
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
     * Set idProducto
     *
     * @param \Usuarios\ManagerBundle\Entity\Producto $idProducto
     * @return ProductoImagenes
     */
    public function setIdProducto(\Usuarios\ManagerBundle\Entity\Producto $idProducto = null)
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
}
