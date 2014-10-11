<?php

namespace Application\GenericoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ApplicationGenericoBundle:Default:index.html.twig', array('name' => $name));
    }
}
