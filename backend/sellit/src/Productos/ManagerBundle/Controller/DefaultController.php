<?php

namespace Productos\ManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProductosManagerBundle:Default:index.html.twig', array('name' => $name));
    }
}
