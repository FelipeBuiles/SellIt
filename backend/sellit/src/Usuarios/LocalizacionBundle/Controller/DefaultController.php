<?php

namespace Usuarios\LocalizacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\ORMException;

class DefaultController extends Controller {

    public function setAction() {
        $response = new JsonResponse();
        
        $data = $this->get('request')->request->all();

        $idusuario = $data['idusuario'];
        $latitud = $data['latitud'];
        $longitud = $data['longitud'];
        
        if (empty($idusuario) || empty($latitud) || empty($longitud))
            $this->sendErrorMsg('IDUSUARIO, LATITUD, LONGITUD cant be null or empty');
        
        $usuario = $this->getDoctrine()->getRepository('UsuariosManagerBundle:Usuarios')->findOneBy(array('idFront' => $idusuario));

        if (is_null($usuario))
            $this->sendErrorMsg('IDUSUARIO not exists');
        
        $usuario->setLatitud($latitud);
        $usuario->setLongitud($longitud);
        
        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();
        } catch (ORMException $ex) {
            $errorResponse = new JsonResponse();
            $errorResponse->setStatusCode(500);
            $errorResponse->setData(array('error' => 'An error ocurred while inserting coordinates', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));
            $errorResponse->send();
            exit;
        }
        
        $response->setStatusCode(200);
        $response->setData(array('result' => true, 'message' => 'Coordinates successfully inserted', 'id' => $usuario->getId()));

        return $response;
    }

    public function getAction($idusuario) {
        $response = new JsonResponse();

        $usuario = $this->getDoctrine()->getRepository('UsuariosManagerBundle:Usuarios')->findOneBy(array('idFront' => $idusuario));

        if (is_null($usuario))
            $this->sendErrorMsg('IDUSUARIO not exists');

        $json['latitud'] = $usuario->getLatitud();
        $json['longitud'] = $usuario->getLongitud();

        $response->setData($json);
        $response->setStatusCode(200);

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
