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
    
    public function getUsuarioAction($idusuario){
        $response = new JsonResponse();
        
        $usuario = $this->getDoctrine()->getRepository('SeguidoresManagerBundle:Usuarios')->findOneBy(array('idFront' => $idusuario));
        
        if (is_null($usuario))
            $this->sendErrorMsg('IDUSUARIO not exists');
        
        $json['id'] = $usuario->getIdFront();
        $json['nombre'] = $usuario->getNombre();
        $json['ruta_avatar'] = $usuario->getRutaAvatar();
        $json['latitud'] = $usuario->getLatitud();
        $json['longitud'] = $usuario->getLongitud();
        
        $response->setData($json);
        $response->setStatusCode(200);
        
        return $response;
    }

    public function validateOnLoginAction() {
        $request = $this->get('request');
        $response = new JsonResponse();

        $data = $this->get('request')->request->all();
        
        $id = $data['id'];
        $nombre = $data['nombre'];
        $ruta_avatar = $data['ruta_avatar'];

        $usuario = $this->getDoctrine()->getRepository('UsuariosManagerBundle:Usuarios')->findOneBy(array('idFront' => $id));

        if (is_null($usuario)) {
            try {
                $sql = "INSERT INTO usuarios (id_front, nombre, fecha_registro, ruta_avatar) VALUES ('".$id."', '".$nombre."',now(), '".$ruta_avatar."')";
                $this->getDoctrine()->getEntityManager()->getConnection()->prepare($sql)->execute();
                
            } catch (ORMException $ex) {
                $errorResponse = new JsonResponse();
                $errorResponse->setStatusCode(200);
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

    public function listarUsuariosAction(){
        $response = new JsonResponse();
        
        
        $arr_response = array();
        $usuarios = $this->getDoctrine()->getRepository('UsuariosManagerBundle:Usuarios')
                ->findAll();
        
        foreach($usuarios as $u){
            $arr['id'] = $u->getIdFront();
            $arr['nombre'] = $u->getNombre();
            $arr['ruta_avatar'] = $u->getRutaAvatar();
            
            $preferenciasUsuario = $this->getDoctrine()->getRepository('UsuariosManagerBundle:UsuarioPreferencias')
                    ->findBy(array('idusuario' => $u));
            
            $arr['preferencias'] = array();
            
            foreach($preferenciasUsuario as $pu)
                $arr['preferencias'][$pu->getIdcategoria()->getId()] = $pu->getIdcategoria()->getCategoria();

            array_push($arr_response, $arr);
        }
        
        $response->setData($arr_response);
        $response->setStatusCode(200);
        
        return $response;
    }
        
    public function frontPKtoSystem($key){
        $key = $this->getDoctrine()->getRepository('UsuariosManagerBundle:Usuarios')->findOneBy(array('idFront' => $key));
        
        if(is_null($key))
            return false;
        else
            return $key->getId();
    }
    
    public function sendErrorMsg($msg) {
        $response = new JsonResponse();
        $response->setData(array('error' => $msg));
        $response->setStatusCode(200);
        $response->send();
        exit;
    }
    
}
