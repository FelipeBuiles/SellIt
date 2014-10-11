<?php

namespace Productos\CreacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProductosCreacionBundle:Default:index.html.twig', array('name' => $name));
    }
}
