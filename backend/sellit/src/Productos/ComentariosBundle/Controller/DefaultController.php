<?php

namespace Productos\ComentariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\ORMException;
use Productos\ManagerBundle\Entity\ProductoComentarios;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('ProductosComentariosBundle:Default:index.html.twig', array('name' => $name));
    }

    public function crearComentarioAction() {
        $request = $this->get('request');
        $response = new JsonResponse();

        //$data = json_decode(file_get_contents('php://input'), true);
        $data = $this->get('request')->request->all();
        $this->parsePost($data);

        $comentario = $data['comentario'];
        $idusuario = $data['idusuario'];
        $idproducto = $data['idproducto'];

        $usuario = $this->getDoctrine()->getRepository('ProductosManagerBundle:Usuarios')->find($idusuario);
        $producto = $this->getDoctrine()->getRepository('ProductosManagerBundle:Producto')->find($idproducto);

        try {
            $comentario = new ProductoComentarios();
            $comentario->setComentario($comentario);
            $comentario->setIdProducto($producto);
            $comentario->setIdUsuario($usuario);

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

    public function borrarComentarioAction() {
        $request = $this->get('request');
        $response = new JsonResponse();

        //$data = json_decode(file_get_contents('php://input'), true);
        $data = $this->get('request')->request->all();
        $id_comentario = $data['comentario'];

        $comentario = $this->getDoctrine()->getRepository('ProductosManagerBundle:ProductoComentarios')->find($id_comentario);
        if (!is_null($comentario)) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->remove($comentario);
                $em->flush();
            } catch (ORMException $ex) {
                $errorResponse = new JsonResponse();
                $errorResponse->setStatusCode(500);
                $errorResponse->setData(array('error' => 'An error ocurred while deleting comment', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));

                return $errorResponse;
                exit;
            }
        } else {
            $response->setData(array("error" => "Requested producto doesnt exists"));
            $response->setStatusCode(404);
            return $response;
        }


        $response->setData(array('result' => true, 'message' => 'Comment deleted'));
        $response->setStatusCode(200);
        return $response;
    }

    public function listarAction($idproducto) {
        $request = $this->get('request');
        $response = new JsonResponse();

        if (!is_null($idproducto)) {
            $producto = $this->getDoctrine()->getRepository('ProductosManagerBundle:Producto')->find($idproducto);
            if (!is_null($producto)) {
                $comentarios = $this->getDoctrine()->getRepository('ProductosManagerBundle:ProductoComentarios')
                        ->findBy(array('idProducto' => $producto), array('id' => 'ASC'));

                $json = array();
                foreach ($comentarios as $c)
                    array_push($json, $c->getComentario());
            } else {
                $response->setData(array("error" => "Requested producto doesnt exists"));
                $response->setStatusCode(404);
                return $response;
            }
        } else {
            $response->setData(array("error" => "IDPRODUCTO variable cant be null or empty"));
            $response->setStatusCode(404);
            return $response;
        }

        $response->setData($json);
        $response->setStatusCode(200);
        return $response;
    }

    public function parsePost($data) {
        $badParseResponse = new JsonResponse();
        $badParseResponse->setStatusCode(500);
        if (is_null($data['comentario']) || empty($data['comentario'])) {
            $badParseResponse->setData(array('error' => 'missing input parameter', 'details' => '"COMENTARIO" parameter is missing or empty'));
            $badParseResponse->send();
            exit;
        } else if (is_null($data['idusuario']) || empty($data['idusuario'])) {
            $badParseResponse->setData(array('error' => 'missing input parameter', 'details' => '"IDUSUARIO" parameter is missing or empty'));
            $badParseResponse->send();
            exit;
        } else if (is_null($data['idproducto']) || empty($data['idproducto'])) {
            $badParseResponse->setData(array('error' => 'missing input parameter', 'details' => '"IDPRODUCTO" parameter is missing or empty'));
            $badParseResponse->send();
            exit;
        } else {
            return true;
        }
    }

}
