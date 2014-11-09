<?php

namespace Application\GenericoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller {

    public function getDepartamentosAction($toArray) {
        $response = new JsonResponse();
        $response->setStatusCode(200);

        $query = $this->getDoctrine()->getRepository('ApplicationGenericoBundle:Departamentos')
                ->findBy(array('activo' => true), array('nombre' => 'ASC'));

        $response->setData($this->encodeToArray($query));

        return $response;
    }

    public function getMunicipiosAction($departamento, $toArray) {
        $response = new JsonResponse();
        $response->setStatusCode(200);

        if (is_null($departamento)) {
            $query = $this->getDoctrine()->getRepository('ApplicationGenericoBundle:Municipios')
                    ->findBy(array(), array('nombre' => 'ASC'));
        } else {
            $departamento = $this->getDoctrine()->getRepository('ApplicationGenericoBundle:Departamentos')
                    ->findBy(array('id' => $departamento, 'activo' => true));

            $query = $this->getDoctrine()->getRepository('ApplicationGenericoBundle:Municipios')
                    ->findBy(array('idDepartamento' => $departamento, 'activo' => true), array('nombre' => 'ASC'));
        }
        $response->setData($this->encodeToArray($query));

        return $response;
    }

    public static function encodeToArray($input) {
        $response = array();

        foreach ($input as $key => $i)
            $response[$i->getId()] = $i->getNombre();

        return $response;
    }

    public static function decodeFromArray() {
        
    }

    public static function decodeRequest() {
        
    }

    public static function RandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 15; $i++)
            $randstring = $characters[rand(0, strlen($characters))];

        return $randstring;
    }

    public static function base64_to_file($base64, $outputFile) {
        $data = explode(',', $base64);

        $base64_string = $data[1];
        $file = fopen($outputFile, "wb");
        fwrite($file, base64_decode($base64_string));
        fclose($file);
    }
    
    public static function file_to_base64($inputFile){
        $content = file_get_contents($inputFile);
        return base64_encode($content);
    }

}
