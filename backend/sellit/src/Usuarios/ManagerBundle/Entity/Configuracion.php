<?php

namespace Usuarios\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Configuracion
 */
class Configuracion
{
    /**
     * @var string
     */
    private $configuracion;

    /**
     * @var string
     */
    private $valor;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set configuracion
     *
     * @param string $configuracion
     * @return Configuracion
     */
    public function setConfiguracion($configuracion)
    {
        $this->configuracion = $configuracion;

        return $this;
    }

    /**
     * Get configuracion
     *
     * @return string 
     */
    public function getConfiguracion()
    {
        return $this->configuracion;
    }

    /**
     * Set valor
     *
     * @param string $valor
     * @return Configuracion
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string 
     */
    public function getValor()
    {
        return $this->valor;
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
}
