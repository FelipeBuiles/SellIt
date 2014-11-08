<?php

namespace Seguidores\ManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SeguidoresManagerBundle:Default:index.html.twig', array('name' => $name));
    }
}
