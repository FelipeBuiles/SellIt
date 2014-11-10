<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Application\GenericoBundle\ApplicationGenericoBundle(),
            new Usuarios\ManagerBundle\UsuariosManagerBundle(),
            new Usuarios\ReputacionBundle\UsuariosReputacionBundle(),
            new Productos\CreacionBundle\ProductosCreacionBundle(),
            new Productos\ManagerBundle\ProductosManagerBundle(),
            new Productos\ImagenesBundle\ProductosImagenesBundle(),
            new Productos\NegociacionBundle\ProductosNegociacionBundle(),
            new Productos\PreguntasBundle\ProductosPreguntasBundle(),
            new Productos\ComentariosBundle\ProductosComentariosBundle(),
            new Usuarios\ConsultaPreferenciasBundle\UsuariosConsultaPreferenciasBundle(),
            new Usuarios\PreferenciasBundle\UsuariosPreferenciasBundle(),
            new Seguidores\ManagerBundle\SeguidoresManagerBundle(),
            new Productos\CalificacionBundle\ProductosCalificacionBundle(),
            new Usuarios\LocalizacionBundle\UsuariosLocalizacionBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
