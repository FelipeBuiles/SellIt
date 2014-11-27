<?php

namespace Usuarios\MetasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Usuarios\ManagerBundle\Entity\UsuarioMetas;
use Usuarios\ManagerBundle\Entity\UsuarioMetaReporte;
use Usuarios\ManagerBundle\Entity\SeguidoresMeta;

class DefaultController extends Controller {

    public function getAction($idmeta) {
        $response = new JsonResponse();
        

        $usuario = $this->getDoctrine()->getRepository('UsuariosManagerBundle:Usuarios')->findOneBy(array('idFront' => $idmeta));

        if (is_null($usuario))
            $this->sendErrorMsg('IDUSUARIO not exists');

        // $meta = $this->getDoctrine()->getRepository('UsuariosManagerBundle:UsuarioMetas')
        //        ->find($idmeta);

        $meta = $this->getDoctrine()->getRepository('UsuariosManagerBundle:UsuarioMetas')
                ->findOneBy(array('idusuario' => $usuario));

        if (is_null($meta))
            $this->sendErrorMsg('IDMETA not exists');
     
        $usuario = $meta->getIdusuario();
        $json_usuario_child['id'] = $usuario->getIdFront();
        $json_usuario_child['nombre'] = $usuario->getNombre();
        $json_usuario_child['ruta_avatar'] = $usuario->getRutaAvatar();
        $json_usuario_child['latitud'] = $usuario->getLatitud();
        $json_usuario_child['longitud'] = $usuario->getLongitud();

        $json['id'] = $meta->getIdFront();
        $json['monto_meta'] = $meta->getMontoMeta();
        $json['descripcion'] = $meta->getDescripcion();
        $json['estado'] = $meta->getEstado();
        $json['porcentaje_avance'] = $this->calcularAvance($meta);
        $json['usuario'] = $json_usuario_child;
        
        $response->setStatusCode(200);
        $response->setData($json);

        return $response;
        
    }

    public function crearAction() {
        $response = new JsonResponse();
        $data = $this->get('request')->request->all();

        $idusuario = $data['idusuario'];
        $monto_meta = $data['monto_meta'];
        $descripcion = $data['descripcion'];

        if (empty($idusuario) || empty($descripcion) || empty($monto_meta))
            $this->sendErrorMsg('IDUSUARIO, MONTO_META and IDFOLLOW cant be null or empty');

        $usuario = $this->getDoctrine()->getRepository('UsuariosManagerBundle:Usuarios')->findOneBy(array('idFront' => $idusuario));

        if (is_null($usuario))
            $this->sendErrorMsg('IDUSUARIO not exists');

        $meta = new UsuarioMetas();
        $meta->setIdusuario($usuario);
        $meta->setMontoMeta($monto_meta);
        $meta->setEstado('E');
        $meta->setDescripcion($descripcion);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($meta);
            $em->flush();
        } catch (ORMException $ex) {
            $errorResponse = new JsonResponse();
            $errorResponse->setStatusCode(500);
            $errorResponse->setData(array('error' => 'An error ocurred while inserting meta', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));
            $errorResponse->send();
            exit;
        }

        $response->setStatusCode(200);
        $response->setData(array('result' => true, 'message' => 'Meta successfully inserted', 'id' => $meta->getId()));

        return $response;
    }

    public function seguirAction($idusuario, $idmeta) {
        $response = new JsonResponse();

        if (empty($idusuario) || empty($idmeta))
            $this->sendErrorMsg('IDUSUARIO and IDMETA cant be null or empty');

        $usuario = $this->getDoctrine()->getRepository('UsuariosManagerBundle:Usuarios')->findOneBy(array('idFront' => $idusuario));

        if (is_null($usuario))
            $this->sendErrorMsg('IDUSUARIO not exists');

        $meta = $this->getDoctrine()->getRepository('UsuariosManagerBundle:UsuarioMetas')->find($idmeta);

        if (is_null($meta))
            $this->sendErrorMsg('IDMETA not exists');

        $check = $this->getDoctrine()->getRepository('UsuariosManagerBundle:SeguidoresMeta')
                ->findOneBy(array('idseguidor' => $usuario, 'idmeta' => $meta));

        if (!is_null($check))
            $this->sendErrorMsg('IDUSER already following');


        $seguidor = new SeguidoresMeta();
        $seguidor->setIdmeta($meta);
        $seguidor->setIdseguidor($usuario);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($seguidor);
            $em->flush();
        } catch (ORMException $ex) {
            $errorResponse = new JsonResponse();
            $errorResponse->setStatusCode(500);
            $errorResponse->setData(array('error' => 'An error ocurred while inserting follower', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));
            $errorResponse->send();
            exit;
        }

        $response->setStatusCode(200);
        $response->setData(array('result' => true, 'message' => 'Follower successfully inserted', 'id' => $seguidor->getId()));

        return $response;
    }

    public function reportarAvanceAction() {
        $response = new JsonResponse();
        
        $data = $this->get('request')->request->all();

        $idmeta = $data['idmeta'];
        $monto = $data['monto'];
        
        if (empty($idmeta) || empty($monto))
            $this->sendErrorMsg('MONTO and IDMETA cant be null or empty');

        $meta = $this->getDoctrine()->getRepository('UsuariosManagerBundle:UsuarioMetas')->find($idmeta);

        if (is_null($meta))
            $this->sendErrorMsg('IDMETA not exists');
        
        $reporte = new UsuarioMetaReporte();
        $reporte->setAvanceDinero($monto);
        $reporte->setIdmeta($meta);
        
        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reporte);
            $em->flush();
        } catch (ORMException $ex) {
            $errorResponse = new JsonResponse();
            $errorResponse->setStatusCode(500);
            $errorResponse->setData(array('error' => 'An error ocurred while inserting avance', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));
            $errorResponse->send();
            exit;
        }

        $response->setStatusCode(200);
        $response->setData(array('result' => true, 'message' => 'Avance successfully inserted', 'id' => $reporte->getId()));

        return $response;
        
    }

    public function calcularAvance(UsuarioMetas $meta) {
        $reportes = $this->getDoctrine()->getRepository('UsuariosManagerBundle:UsuarioMetaReporte')
                ->findBy(array('idmeta' => $meta));

        $acumulado = 0;

        foreach ($reportes as $r)
            $acumulado += $r->getAvanceDinero();


        $total_meta = $meta->getMontoMeta();
        $avance = round(($acumulado * 100) / $total_meta,2);

        return $avance . " %";
    }

    public function cancelarAction() {
        $response = new JsonResponse();
        $data = $this->get('request')->request->all();

        $idusuario = $data['idusuario'];
        $idmeta = $data['idmeta'];

        if (empty($idusuario) || empty($idmeta))
            $this->sendErrorMsg('IDUSUARIO and IDMETA cant be null or empty');

        $usuario = $this->getDoctrine()->getRepository('UsuariosManagerBundle:Usuarios')->findOneBy(array('idFront' => $idusuario));

        if (is_null($usuario))
            $this->sendErrorMsg('IDUSUARIO not exists');

        $meta = $this->getDoctrine()->getRepository('UsuariosManagerBundle:UsuarioMetas')
                ->findOneBy(array('idusuario' => $usuario, 'id' => $idmeta));

        if (is_null($meta))
            $this->sendErrorMsg('IDMETA not exists');

        $meta->setEstado('A');


        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($meta);
            $em->flush();
        } catch (ORMException $ex) {
            $errorResponse = new JsonResponse();
            $errorResponse->setStatusCode(500);
            $errorResponse->setData(array('error' => 'An error ocurred while canceling meta', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));
            $errorResponse->send();
            exit;
        }

        $response->setStatusCode(200);
        $response->setData(array('result' => true, 'message' => 'Meta successfully canceled', 'id' => $seguidor->getId()));

        return $response;
    }

    public function listarMetasSeguidasAction($idusuario) {
        $response = new JsonResponse();

        if (empty($idusuario))
            $this->sendErrorMsg('IDUSUARIO cant be null or empty');

        $usuario = $this->getDoctrine()->getRepository('UsuariosManagerBundle:Usuarios')->findOneBy(array('idFront' => $idusuario));

        if (is_null($usuario))
            $this->sendErrorMsg('IDUSUARIO not exists');


        $seguidas = $this->getDoctrine()->getRepository('UsuariosManagerBundle:SeguidoresMeta')
                ->findBy(array('idseguidor' => $usuario));

        $json = array();

        foreach ($seguidas as $s) {
            $usuario = $s->getIdmeta()->getIdusuario();
            $json_usuario_child['id'] = $usuario->getIdFront();
            $json_usuario_child['nombre'] = $usuario->getNombre();
            $json_usuario_child['ruta_avatar'] = $usuario->getRutaAvatar();
            $json_usuario_child['latitud'] = $usuario->getLatitud();
            $json_usuario_child['longitud'] = $usuario->getLongitud();

            $json['id'] = $s->getIdmeta()->getIdFront();
            $json_child['monto_meta'] = $s->getIdmeta()->getMontoMeta();
            $json_child['descripcion'] = $s->getIdmeta()->getDescripcion();
            $json_child['estado'] = $s->getIdmeta()->getEstado();
            $json_child['porcentaje_avance'] = $this->calcularAvance($s->getIdmeta());
            $json_child['usuario'] = $json_usuario_child;

            array_push($json, $json_child);
        }

        $response->setStatusCode(200);
        $response->setData($json);

        return $response;
    }

    public function listarSeguidoresMetaAction($idmeta) {
        $response = new JsonResponse();

        if (empty($idmeta))
            $this->sendErrorMsg('IDMETA cant be null or empty');

        $meta = $this->getDoctrine()->getRepository('UsuariosManagerBundle:UsuarioMetas')
                ->find($idmeta);

        if (is_null($meta))
            $this->sendErrorMsg('IDMETA not exists');

        $seguidores = $this->getDoctrine()->getRepository('UsuariosManagerBundle:SeguidoresMeta')
                ->findBy(array('idmeta' => $meta));

        $json = array();

        foreach ($seguidores as $s) {
            $usuario = $s->getIdseguidor();

            $json_child['id'] = $usuario->getIdFront();
            $json_child['nombre'] = $usuario->getNombre();
            $json_child['ruta_avatar'] = $usuario->getRutaAvatar();
            $json_child['latitud'] = $usuario->getLatitud();
            $json_child['longitud'] = $usuario->getLongitud();

            array_push($json, $json_child);
        }

        $response->setStatusCode(200);
        $response->setData($json);

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
