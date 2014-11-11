<?php
namespace Productos\NegociacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\ORMException;
//use Productos\ManagerBundle\Entity\ProductoOfertas;

class OfertasController extends Controller {

    public function ofertarAction() {
        $response = new JsonResponse();
        $data = $this->get('request')->request->all();

        $producto = $data['producto'];
        $usuario = $data['usuario'];
        $oferta = $data['oferta'];
        $comentarios = $data['comentarios'];
        
        $producto = $this->getDoctrine()->getRepository('ProductosManagerBundle:Producto')->find($producto);
        $usuario = $this->getDoctrine()->getRepository('ProductosManagerBundle:Usuarios')->findOneBy(array('idFront' => $usuario));

        if(is_null($producto)){
            $response->setData(array('error' => true, 'message' => 'The product doesnt exists'));
            $response->setStatusCode(500);
            $response->send();
            exit;
        }

        if(is_null($usuario)){
           $response->setData(array('error' => true, 'message' => 'The user requested doesnt exists'));
            $response->setStatusCode(500);
            $response->send();
            exit; 
        }

        try {
            $oferta = new \Productos\ManagerBundle\Entity\ProductoOfertas();
            $oferta->setIdProducto($producto);
            $oferta->setIdUsuario($usuario);
            $oferta->setOferta($oferta);
            $oferta->setComentarios($comentarios);
            $oferta->setEstadoOferta('P');
                        
            /*$oferta->setComentarios($comentarios);
            $oferta->setIdProducto($producto);
            $oferta->setIdUsuario($usuario);
            $oferta->setOferta($oferta);*/
            //$oferta->setEstadoOferta('P');
                        
//echo "aaa"; exit;

            $em = $this->getDoctrine()->getManager();
            $em->persist($oferta);
            $em->flush();
        } catch (ORMException $ex) {
            $errorResponse = new JsonResponse();
            $errorResponse->setStatusCode(500);
            $errorResponse->setData(array('error' => 'An error ocurred while creating offer', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));

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
        
        $oferta = $data['idoferta'];

        if(is_null($oferta)){
            $response->setData(array('error' => true, 'message' => 'The offer requested doesnt exists'));
            $response->setStatusCode(500);
            $response->send();
            exit;
        }
        
        $oferta = $this->getDoctrine()->getRepository('ProductosManagerBundle:ProductoOfertas')->find($oferta);
        
        
        try {
            $oferta->setEstadoOferta("R");
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($oferta);
            $em->flush();
        } catch (ORMException $ex) {
            $errorResponse = new JsonResponse();
            $errorResponse->setStatusCode(500);
            $errorResponse->setData(array('error' => 'An error ocurred while updating offer', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));

            return $errorResponse;
            exit;
        }
        
        $response->setStatusCode(200);
        $response->setData(array('result' => true, 'message' => 'Offer  successfully rejected', 'id' => $oferta->getId()));

        return $response;
    }

    public function aceptarOfertaAction() {
        $response = new JsonResponse();
        $data = $this->get('request')->request->all();
        
        $oferta = $data['idoferta'];

        if(is_null($oferta)){
            $response->setData(array('error' => true, 'message' => 'The offer requested doesnt exists'));
            $response->setStatusCode(500);
            $response->send();
            exit;
        }
        
        $oferta = $this->getDoctrine()->getRepository('ProductosManagerBundle:ProductoOfertas')->find($oferta);
        
        try {
            $oferta->setEstadoOferta("A");
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($oferta);
            $em->flush();
        } catch (ORMException $ex) {
            $errorResponse = new JsonResponse();
            $errorResponse->setStatusCode(500);
            $errorResponse->setData(array('error' => 'An error ocurred while updating offer', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));

            return $errorResponse;
            exit;
        }
        
        $response->setStatusCode(200);
        $response->setData(array('result' => true, 'message' => 'Offer  successfully accepted', 'id' => $oferta->getId()));

        return $response;
    }

    public function listarAction($idproducto) {
        $response = new JsonResponse();

        $producto = $this->getDoctrine()->getRepository('ProductosManagerBundle:Producto')->find($idproducto);

        if (!is_null($producto)) {
            $ofertas = $this->getDoctrine()->getRepository('ProductosManagerBundle:ProductoOfertas')->findBy(array('idProducto' => $producto), array('id' => 'DESC'));
            if (!is_null($ofertas)) {
                $json = array();
                foreach ($ofertas as $o) {
                    if ($o->getEstadoOferta() == "A")
                        $estado_oferta = "Aceptada";
                    else if ($o->getEstadoOferta() == "R")
                        $estado_oferta = "Rechazada";
                    else if ($o->getEstadoOferta() == "P")
                        $estado_oferta = "Pendiente";

                    $json_child = array(
                        'producto' => array(
                            'id' => $o->getIdProducto()->getId(),
                            'nombre' => $o->getIdProducto()->getNombre()
                        ),
                        'usuario' => array(
                            'id' => $o->getIdUsuario()->getId(),
                            'nombre' => $o->getIdUsuario()->getNombre(),
                            'ruta_avatar' => $o->getIdUsuario()->getRutaAvatar()
                        ),
                        'oferta' => $o->getOferta(),
                        'comentarios' => $o->getComentarios(),
                        'estado_oferta' => $estado_oferta
                    );

                    array_push($json, $json_child);
                }
            } else {
                $response->setData(array("result" => false, "error" => "No offers to be displayed"));
                $response->setStatusCode(404);
                return $response;
            }
        } else {
            $response->setData(array("error" => "The product doesnt exists"));
            $response->setStatusCode(404);
            return $response;
        }

        $response->setData($json);
        $response->setStatusCode(200);
        return $response;
    }

}
