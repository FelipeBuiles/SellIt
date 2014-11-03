<?php

namespace Usuarios\PreferenciasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller {

    public function addAction() {
        $response = new JsonResponse();
        
        $data = $this->get('request')->request->all();
        $idusuario = $data['idusuario'];
        $idcategoria = $data['idcategoria'];

        if (empty($idusuario) || empty($idcategoria)) {
            $response->setData(array("error" => "IDUSUARIO and IDCATEGORIA cant be null or empty"));
            $response->setStatusCode(500);
            $response->send();
            exit;
        }

        $usuario = $this->getDoctrine()->getRepository('UsuariosManagerBundle:Usuarios')
                ->findOneBy(array('idFront' => $idusuario));

        if (is_null($usuario)) {
            $response->setData(array("error" => "USUARIO doesnt exists"));
            $response->setStatusCode(500);
            $response->send();
            exit;
        }

        $categoria = $this->getDoctrine()->getRepository('UsuariosManagerBundle:CategoriaProducto')
                ->find($idcategoria);

        if (is_null($categoria)) {
            $response->setData(array("error" => "CATEGORIA doesnt exists"));
            $response->setStatusCode(500);
            $response->send();
            exit;
        }

        $nuevaPreferencia = new \Usuarios\ManagerBundle\Entity\UsuarioPreferencias();
        $nuevaPreferencia->setIdcategoria($categoria);
        $nuevaPreferencia->setIdusuario($usuario);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($nuevaPreferencia);
            $em->flush();
        } catch (ORMException $ex) {
            $errorResponse = new JsonResponse();
            $errorResponse->setStatusCode(500);
            $errorResponse->setData(array('error' => 'An error ocurred while inserting preference', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));

            return $errorResponse;
            exit;
        }
        
        $response->setData(array('result' => true,'message' => 'Preference successfully inserted', 'id' => $nuevaPreferencia->getId()));
        $response->setStatusCode(200);
        return $response;
    }

    public function getAction($idusuario) {
        $request = $this->get('request');
        $response = new JsonResponse();

        if (is_null($idusuario)) {
            $response->setData(array("error" => "IDUSUARIO cant be null or empty"));
            $response->setStatusCode(500);
            $response->send();
            exit;
        }

        $usuario = $this->getDoctrine()->getRepository('UsuariosManagerBundle:Usuarios')
                ->findOneBy(array('idFront' => $idusuario));

        if (is_null($usuario)) {
            $response->setData(array("error" => "USUARIO not exists"));
            $response->setStatusCode(500);
            $response->send();
            exit;
        }

        $preferencias = $this->getDoctrine()->getRepository('UsuariosManagerBundle:UsuarioPreferencias')
                ->findBy(array('idusuario' => $usuario));

        $arrResponse = array();

        foreach ($preferencias as $p)
            $arrResponse[$p->getIdcategoria()->getId()] = $p->getIdcategoria()->getCategoria();

        $response->setData($arrResponse);
        $response->setStatusCode(200);

        return $response;
    }

}
