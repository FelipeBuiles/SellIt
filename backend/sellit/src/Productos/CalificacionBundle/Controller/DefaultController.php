<?php

namespace Productos\CalificacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Productos\ManagerBundle\Entity\ProductoCalificacion;

class DefaultController extends Controller {

    public function calificarAction() {
        $response = new JsonResponse();

        $data = $this->get('request')->request->all();
        $idusuario = $data['idusuario'];
        $idproducto = $data['idproducto'];
        $score = $data['calificacion'];

        if (empty($idusuario) || empty($idproducto) || empty($score))
            $this->sendErrorMsg('IDUSUARIO, CALIFICACION and IDPRODUCTO cant be null or empty');

        $usuario = $this->getDoctrine()->getRepository('ProductosManagerBundle:Usuarios')->findOneBy(array('idFront' => $idusuario));
        $producto = $this->getDoctrine()->getRepository('ProductosManagerBundle:Producto')->find($idproducto);

        if (is_null($usuario))
            $this->sendErrorMsg('USUARIO not exists');

        if (is_null($producto))
            $this->sendErrorMsg('PRODUCTO NOT EXISTS');

        //Consultamos si la calificacion ya existe y en caso de que exista la ignoramos
        $relacion = $this->getDoctrine()->getRepository('ProductosManagerBundle:ProductoCalificacion')
                ->findOneBy(array('idusuario' => $usuario, 'idproducto' => $producto));

        if (is_null($relacion)) {
            $calificacion = new ProductoCalificacion();
            $calificacion->setIdproducto($producto);
            $calificacion->setIdusuario($usuario);
            $calificacion->setCalificacion($score);

            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($calificacion);
                $em->flush();
            } catch (ORMException $ex) {
                $errorResponse = new JsonResponse();
                $errorResponse->setStatusCode(200);
                $errorResponse->setData(array('error' => 'An error ocurred while inserting Evaluation', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));
                $errorResponse->send();
                exit;
            }

            $response->setStatusCode(200);
            $response->setData(array('result' => true, 'message' => 'Evaluation successfully inserted', 'id' => $calificacion->getId()));
        } else {
            $response->setData(array('result' => false, 'message' => 'Already'));
        }

        return $response;
    }

    public function getCalificacionAction($idproducto) {
        $response = new JsonResponse();

        if (empty($idproducto))
            $this->sendErrorMsg('IDPRODUCTO cant be null or empty');

        $producto = $this->getDoctrine()->getRepository('ProductosManagerBundle:Producto')->find($idproducto);

        $calificacion = $this->getDoctrine()->getRepository('ProductosManagerBundle:ProductoCalificacion')
                ->findBy(array('idproducto' => $producto));

        $score = 0;

        if (!is_null($calificacion)) {
            foreach ($calificacion as $c) {
                $score += $c->getCalificacion();
            }
            
            $score = $score / sizeof($calificacion);
        }

        $response->setStatusCode(200);
        $response->setData(array($score));

        return $response;
    }

    public function sendErrorMsg($msg) {
        $response = new JsonResponse();
        $response->setData(array('error' => $msg));
        $response->setStatusCode(200);
        $response->send();
        exit;
    }
}
