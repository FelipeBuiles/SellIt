<?php

namespace Usuarios\HistoricoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UsuariosHistoricoBundle:Default:index.html.twig', array('name' => $name));
    }
}
