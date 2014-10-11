<?php

namespace Productos\PreguntasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProductosPreguntasBundle:Default:index.html.twig', array('name' => $name));
    }
}
