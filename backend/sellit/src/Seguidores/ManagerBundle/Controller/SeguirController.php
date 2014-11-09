<?php

namespace Seguidores\ManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Seguidores\ManagerBundle\Entity\UsuarioSeguidores;
use Symfony\Component\HttpFoundation\JsonResponse;

class SeguirController extends Controller {

    public function seguirAction() {
        $response = new JsonResponse();

        $data = $this->get('request')->request->all();
        $idusuario = $data['idusuario'];
        $idfollow = $data['idfollow'];

        if (empty($idusuario) || empty($idfollow))
            $this->sendErrorMsg('IDUSUARIO and IDFOLLOW cant be null or empty');

        $usuario = $this->getDoctrine()->getRepository('SeguidoresManagerBundle:Usuarios')->findOneBy(array('idFront' => $idusuario));
        $usuarioFollow = $this->getDoctrine()->getRepository('SeguidoresManagerBundle:Usuarios')->findOneBy(array('idFront' => $idfollow));

        if (is_null($usuario))
            $this->sendErrorMsg('IDUSUARIO not exists');

        if (is_null($usuarioFollow))
            $this->sendErrorMsg('IDFOLLOW NOT EXISTS');


        //Consultamos si la relacion ya existe y en caso de que exista la ignoramos
        $relacion = $this->getDoctrine()->getRepository('SeguidoresManagerBundle:UsuarioSeguidores')
                ->findOneBy(array('idusuario' => $usuario, 'idseguido' => $usuarioFollow));

        if (is_null($relacion)) {
            $seguir = new UsuarioSeguidores();
            $seguir->setIdusuario($usuario);
            $seguir->setIdseguido($usuarioFollow);

            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($seguir);
                $em->flush();
            } catch (ORMException $ex) {
                $errorResponse = new JsonResponse();
                $errorResponse->setStatusCode(500);
                $errorResponse->setData(array('error' => 'An error ocurred while inserting follower', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));
                $errorResponse->send();
                exit;
            }

            $response->setStatusCode(200);
            $response->setData(array('result' => true, 'message' => 'Follower successfully inserted', 'id' => $seguir->getId()));
        } else {
            $response->setData(array('result' => false, 'message' => 'Already following this user'));
        }

        return $response;
    }

    public function listarSeguidosAction($idusuario) {
        $response = new JsonResponse();

        if (empty($idusuario))
            $this->sendErrorMsg('IDUSUARIO and IDFOLLOW cant be null or empty');

        $usuario = $this->getDoctrine()->getRepository('SeguidoresManagerBundle:Usuarios')->findOneBy(array('idFront' => $idusuario));
        if (is_null($usuario))
            $this->sendErrorMsg('IDUSUARIO not exists');

        $seguidos = $this->getDoctrine()->getRepository('SeguidoresManagerBundle:UsuarioSeguidores')->findBy(array('idusuario' => $usuario));

        $json = array();

        foreach ($seguidos as $s) {
            $json_child['id'] = $s->getIdseguido()->getIdFront();
            $json_child['nombre'] = $s->getIdseguido()->getNombre();
            $json_child['ruta_avatar'] = $s->getIdseguido()->getRutaAvatar();
            $json_child['latitud'] = $s->getIdseguido()->getLatitud();
            $json_child['longitud'] = $s->getIdseguido()->getLongitud();

            array_push($json, $json_child);
        }

        $response->setStatusCode(200);
        $response->setData($json);

        return $response;
    }

    public function listarSeguidoresAction($idusuario) {
        $response = new JsonResponse();

        if (empty($idusuario))
            $this->sendErrorMsg('IDUSUARIO and IDFOLLOW cant be null or empty');

        $usuario = $this->getDoctrine()->getRepository('SeguidoresManagerBundle:Usuarios')->findOneBy(array('idFront' => $idusuario));
        if (is_null($usuario))
            $this->sendErrorMsg('IDUSUARIO not exists');

        $seguidores = $this->getDoctrine()->getRepository('SeguidoresManagerBundle:UsuarioSeguidores')->findBy(array('idseguido' => $usuario));

        $json = array();

        foreach ($seguidores as $s) {
            $json_child['id'] = $s->getIdusuario()->getIdFront();
            $json_child['nombre'] = $s->getIdusuario()->getNombre();
            $json_child['ruta_avatar'] = $s->getIdusuario()->getRutaAvatar();
            $json_child['latitud'] = $s->getIdusuario()->getLatitud();
            $json_child['longitud'] = $s->getIdusuario()->getLongitud();

            array_push($json, $json_child);
        }

        $response->setStatusCode(200);
        $response->setData($json);

        return $response;
    }

    public function sendErrorMsg($msg) {
        $response = new JsonResponse();
        $response->setData(array('error' => $msg));
        $response->setStatusCode(500);
        $response->send();
        exit;
    }

}
