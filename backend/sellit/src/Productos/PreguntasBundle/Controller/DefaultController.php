<?php

namespace Productos\PreguntasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\ORMException;
use Productos\ManagerBundle\Entity\ProductoOfertas;

class DefaultController extends Controller {

    public function ofertarAction() {
        $response = new JsonResponse();
        $data = $this->get('request')->request->all();
        
        $producto = $data['producto'];
        $usuario = $data['usuario'];
        $oferta = $data['oferta'];
        $comentarios = $data['comentarios'];
        
        $producto = $this->getDoctrine()->getRepository('ProductosManagerBundle:Producto')->findOneBy(array('id' => $producto));
        $usuario = $this->getDoctrine()->getRepository('ProductosManagerBundle:Usuarios')->findOneBy(array('idFront' => $usuario));
        
        try {
            $oferta = new ProductoOfertas();
            $oferta->setComentarios($comentarios);
            $oferta->setIdProducto();
            $oferta->setIdUsuario();
            $oferta->setOferta($oferta);
            

            $em = $this->getDoctrine()->getManager();
            $em->persist($comentario);
            $em->flush();
        } catch (ORMException $ex) {
            $errorResponse = new JsonResponse();
            $errorResponse->setStatusCode(500);
            $errorResponse->setData(array('error' => 'An error ocurred while creating comment', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));

            return $errorResponse;
            exit;
        }
        
        $response->setData($json);
        $response->setStatusCode(200);
        return $response;
    }

    public function rechazarOfertaAction() {
        $response = new JsonResponse();
        $data = $this->get('request')->request->all();
        
        $response->setData($json);
        $response->setStatusCode(200);
        return $response;
    }

    public function aceptarOfertaAction() {
        $response = new JsonResponse();
        $data = $this->get('request')->request->all();
        
        $response->setData($json);
        $response->setStatusCode(200);
        return $response;
    }

    public function listarAction($idproducto) {
        $response = new JsonResponse();

        $response->setData($json);
        $response->setStatusCode(200);
        return $response;
        
    }

}
