<?php

namespace Usuarios\ReputacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UsuariosReputacionBundle:Default:index.html.twig', array('name' => $name));
    }
    
}
