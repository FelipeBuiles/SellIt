<?php

namespace Productos\PreguntasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\ORMException;
use Productos\ManagerBundle\Entity\ProductoPreguntas;

class DefaultController extends Controller {

    public function publicarAction() {
        $response = new JsonResponse();
        $data = $this->get('request')->request->all();

        $producto = $data['producto'];
        $usuario = $data['usuario'];
        $texto = $data['texto'];
        $tipo = $data['tipo'];
        $id_pregunta = $data['id_pregunta']; //Solo si el tipo es R para Respuesta


        if ($tipo == "R") {
            if (is_null($producto) || is_null($usuario) || is_null($id_pregunta)) {
                $response->setData(array('error' => true, 'message' => 'The request is a question reply, so, PRODUCTO, USUARIO and ID_PREGUNTA cant be null or empty'));
                $response->setStatusCode(500);
                $response->send();
                exit;
            }
        } else if ($tipo == "P") {
            if (is_null($producto) || is_null($usuario)) {
                $response->setData(array('error' => true, 'message' => 'The request is a question post, so, PRODUCTO and USUARIO cant be null or empty'));
                $response->setStatusCode(500);
                $response->send();
                exit;
            }
        }


        $producto = $this->getDoctrine()->getRepository('ProductosManagerBundle:Producto')->findOneBy(array('id' => $producto));
        $usuario = $this->getDoctrine()->getRepository('ProductosManagerBundle:Usuarios')->findOneBy(array('idFront' => $usuario));
        if ($tipo == "R")
            $respuesta_pregunta = $this->getDoctrine()->getRepository('ProductosManagerBundle:ProductoPreguntas')
                    ->findOneBy(array('id' => $producto));

        if (is_null($producto) || is_null($usuario)) {
            $response->setData(array('error' => true, 'message' => 'User or product dont found'));
            $response->setStatusCode(500);
            $response->send();
            exit;
        }

        try {
            $publicar = new ProductoPreguntas();
            $publicar->setIdProducto($producto);
            $publicar->setIdUsuario($usuario);
            $publicar->setTexto($texto);
            $publicar->setTipo($tipo);
            if ($tipo == "R")
                $publicar->setIdRespuestaPregunta($idRespuestaPregunta);

            $em = $this->getDoctrine()->getManager();
            $em->persist($publicar);
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

    public function borrarPreguntaAction() {
        $response = new JsonResponse();
        $data = $this->get('request')->request->all();
    }

    public function verAction($idproducto) {
        $response = new JsonResponse();
        $data = $this->get('request')->request->all();

        if (is_null($idproducto)) {
            $response->setData(array('error' => true, 'message' => 'IDPRODUCTO Cant be null or empty'));
            $response->setStatusCode(500);
            $response->send();
            exit;
        }

        $producto = $this->getDoctrine()->getRepository('ProductosManagerBundle:ProductoPreguntas')->find($idproducto);

        if (is_null($producto)) {
            $response->setData(array('error' => true, 'message' => 'The requested product doesnt exists'));
            $response->setStatusCode(500);
            $response->send();
            exit;
        }

        $preguntas = $this->getDoctrine()->getRepository('ProductosManagerBundle:ProductoPreguntas')
                ->findBy(array('' => $idproducto), array('id' => 'ASC'));

        $json = array();
        foreach ($preguntas as $p) {
            $json_child = array();

            $json_child['usuario'] = array(
                'name' => $p->getIdUsuario()->getNombre(),
                'ruta_avatar' => $p->getIdUsuario()->getRutaAvatar(),
                'id_front' => $p->getIdUsuario()->getIdFront()
            );

            $json_child['producto'] = array(
                'id' => $p->getIdProducto()->getId(),
                'nombre' => $p->getIdProducto()->getNombre()
            );

            $json_child['tipo'] = $p->getTipo();
            $json_child['texto'] = $p->getTexto();

            if ($p->getTipo() == 'R')
                $json_child['pregunta_raiz'] = array();

            array_push($json, $json_child);
        }

        $response->setData($json);
        $response->setStatusCode(200);
        return $response;
    }

}
