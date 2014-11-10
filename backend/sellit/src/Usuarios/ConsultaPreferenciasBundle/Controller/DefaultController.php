<?php

namespace Usuarios\ConsultaPreferenciasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller {

    public function sugeridosAction() {
        $response = new JsonResponse();

        $data = $this->get('request')->request->all();
        $categorias = $data['preferencias'];

        if (empty($categorias) || sizeof($categorias) == 0)
            $this->sendErrorMsg('PREFERENCIAS cant be null or empty');

        
        $categorias_arr = array();

        foreach ($categorias as $c) {
            $categoria = $this->getDoctrine()->getRepository('UsuariosManagerBundle:CategoriaProducto')->find($c);
            if (!is_null($categoria))
                array_push($categorias_arr, $c);
        }

        $sql = "SELECT u.id AS id, u.nombre AS usuario, count(0) AS coincidencias " .
                "FROM usuarios u " .
                "INNER JOIN producto p ON (u.id=p.id_usuario) " .
                "WHERE p.id_categoria IN (" . implode(",", $categorias_arr) . ") " .
                "GROUP BY u.nombre ORDER BY coincidencias DESC ";

        $query = $this->getDoctrine()->getEntityManager()
                ->getConnection()
                ->prepare($sql);
        $query->execute();
        $usuarios = $query->fetchAll();
        
        if(sizeof($usuarios)>0){
            $json = array();
            
            foreach($usuarios AS $u){
                $usuario = $this->getDoctrine()->getRepository('UsuariosManagerBundle:Usuarios')->find($u['id']);
                $json_child['id'] = $usuario->getIdFront();
                $json_child['nombre'] = $usuario->getNombre();
                $json_child['ruta_avatar'] = $usuario->getRutaAvatar();
                $json_child['latitud'] = $usuario->getLatitud();
                $json_child['longitud'] = $usuario->getLongitud();
                
                array_push($json, $json_child);
            }
            
            $response->setStatusCode(200);
            $response->setData($json);
            
        } else 
            $this->sendErrorMsg('No se encontraron usuarios que concordaran con la busqueda');
                
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
