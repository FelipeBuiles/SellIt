<?php

namespace Usuarios\ManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\ORMException;
use Usuarios\ManagerBundle\Entity\UsuariosBanco;

class BancariaController extends Controller {

    public function setAction() {
        $request = $this->get('request');
        $response = new JsonResponse();

        $data = $this->get('request')->request->all();

        $idusuario = $data['idusuario'];
        $nombre_banco = $data['nombre_banco'];
        $nombre_titular = $data['nombre_titular'];
        $tipo_cuenta = $data['tipo_cuenta'];
        $numero_cuenta = $data['numero_cuenta'];
        $ciudad_titular = (isset($data['ciudad_titular'])) ? $data['ciudad_titular'] : null;
        $informacion_extra = (isset($data['informacion_extra'])) ? $data['informacion_extra'] : null;

        if (empty($idusuario) || empty($nombre_banco) || empty($nombre_titular) || empty($tipo_cuenta) || empty($numero_cuenta))
            $this->sendErrorMsg('IDUSUARIO,NOMBRE_BANCO, NOMBRE_TITULAR, TIPO_CUENTA. NUMERO_CUENTA cant be null or empty');

        $usuario = $this->getDoctrine()->getRepository('UsuariosManagerBundle:Usuarios')->findOneBy(array('idFront' => $idusuario));

        if (is_null($usuario))
            $this->sendErrorMsg('IDUSUARIO not exists');


        //Consultamos si la informacion ya existe y en caso de que exista la actualizamos
        $banco = $this->getDoctrine()->getRepository('UsuariosManagerBundle:UsuariosBanco')
                ->findOneBy(array('idusuario' => $usuario));

        if (is_null($banco)) {
            $banco = new UsuariosBanco();
            $banco->setIdusuario($usuario);
        }

        $banco->setNombreBanco($nombre_banco);
        $banco->setNombreTitular($nombre_titular);
        $banco->setNumeroCuenta($numero_cuenta);
        $banco->setTipoCuenta($tipo_cuenta);

        if (!is_null($ciudad_titular))
            $banco->setCiudadTitular($ciudad_titular);

        if (!is_null($informacion_extra))
            $banco->setInformacionExtra($informacion_extra);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($banco);
            $em->flush();
        } catch (ORMException $ex) {
            $errorResponse = new JsonResponse();
            $errorResponse->setStatusCode(500);
            $errorResponse->setData(array('error' => 'An error ocurred while inserting follower', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));
            $errorResponse->send();
            exit;
        }

        $response->setStatusCode(200);
        $response->setData(array('result' => true, 'message' => 'Bank information successfully inserted', 'id' => $banco->getId()));

        return $response;
    }

    public function getAction($idusuario) {
        $response = new JsonResponse();

        if (empty($idusuario))
            $this->sendErrorMsg('IDUSUARIO and IDFOLLOW cant be null or empty');

        $usuario = $this->getDoctrine()->getRepository('UsuariosManagerBundle:Usuarios')
                ->findOneBy(array('idFront' => $idusuario));
        if (is_null($usuario))
            $this->sendErrorMsg('IDUSUARIO not exists');

        $bancaria = $this->getDoctrine()->getRepository('UsuariosManagerBundle:UsuariosBanco')
                ->findOneBy(array('idusuario' => $usuario));

        if (is_null($bancaria)) {
            $response->setData(array('No bank information available'));
            $response->setStatusCode(200);
            $response->send();
            exit;
        } else {
            $usuario = $bancaria->getIdusuario();

            $json_usuario['id'] = $usuario->getIdFront();
            $json_usuario['nombre'] = $usuario->getNombre();
            $json_usuario['ruta_avatar'] = $usuario->getRutaAvatar();

            $json['usuario'] = $json_usuario;
            $json['nombre_banco'] = $bancaria->getNombreBanco();
            $json['nombre_titular'] = $bancaria->getNombreTitular();
            $json['tipo_cuenta'] = $bancaria->getTipoCuenta();
            $json['numero_cuenta'] = $bancaria->getNumeroCuenta();
            $json['ciudad_titular'] = $bancaria->getCiudadTitular();
            $json['informacion_extra'] = $bancaria->getInformacionExtra();
        }

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
