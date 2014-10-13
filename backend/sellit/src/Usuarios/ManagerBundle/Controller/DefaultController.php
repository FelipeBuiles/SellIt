<?php

namespace Usuarios\ManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\ORMException;
use Usuarios\ManagerBundle\Entity\Usuarios;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('UsuariosManagerBundle:Default:index.html.twig', array('name' => $name));
    }

    public function validateOnLoginAction() {
        $request = $this->get('request');
        $response = new JsonResponse();

        //$data = json_decode(file_get_contents('php://input'), true);
        /*$data = explode('&', file_get_contents('php://input'));
        
        $id = explode('=',$data[0])[1];
        $nombre = explode('=',$data[1])[1];
        $ruta_avatar = explode('=',$data[2])[1];*/
        
        $data = $this->get('request')->request->all();
        
        $id = $data['id'];
        $nombre = $data['nombre'];
        $ruta_avatar = $data['ruta_avatar'];

        $usuario = $this->getDoctrine()->getRepository('UsuariosManagerBundle:Usuarios')->find($id);

        if (is_null($usuario)) {
            try {
                $sql = "INSERT INTO usuarios (id, nombre, fecha_registro, ruta_avatar) VALUES ('".$id."', '".$nombre."',now(), '".$ruta_avatar."')";
                $this->getDoctrine()->getEntityManager()->getConnection()->prepare($sql)->execute();
                
            } catch (ORMException $ex) {
                $errorResponse = new JsonResponse();
                $errorResponse->setStatusCode(500);
                $errorResponse->setData(array('error' => 'An error ocurred while creating user', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));

                return $errorResponse;
                exit;
            }
            $response->setData(array('result' => true, 'message' => "User inserted"));
        } else {
            $response->setData(array('result' => true, 'message' => "The user already was in the database"));
        }
        
        $response->setStatusCode(200);
        return $response;
    }

}
