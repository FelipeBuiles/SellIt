<?php

namespace Productos\ManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Productos\ManagerBundle\Entity\Producto;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProductosManagerBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function verAction($idproducto) {
        $request = $this->get('request'); 
        $response = new JsonResponse();
        
        if($request->getMethod()=='GET'){
            if(!is_null($idproducto) && !empty($idproducto)){
                
                $query = $this->getDoctrine()->getRepository('ProductosManagerBundle:Producto')->findOneBy(array('id' => $idproducto));
                $categoria = null;
                
                
                if(!is_null($query->getIdCategoria()))
                    $categoria = $query->getIdCategoria()->getCategoria();
                
                if(!is_null($query)) {
                    $json = array(
                        'id' => $query->getId(),
                        'nombre' => $query->getNombre(),
                        'descripcion' => $query->getDescripcion(),
                        'estado' => $query->getIdEstado()->getEstado(),
                        'precio' => $query->getPrecio(),
                        'categoria' => $categoria,
                        'fecha_publicacion' => $query->getFechaPublicacion(),
                        'keywords' => $this->getProductKeywords($query),
                        'images' =>$this->getProductImages($query)
                    );
                    
                    $response->setData($json);
                    $response->setStatusCode(200);
                    return $response;
                } else {
                    $response->setData(array("error" => "The product ".$idproducto." doesnt exists"));
                    $response->setStatusCode(404);
                    return $response;
                }
                
            } else {
                $response->setData(array("error" => "IDPRODUCTO cant be null or empty"));
                $response->setStatusCode(500);
                return $response;
            }
        } else {
            $response->setData(array('error' => 'ONLY GET METHOD ALLOWED'));
            $response->setStatusCode(500);
            return $response;
        }
    }
    
    public function getProductKeywords(Producto $producto){
        $query = $this->getDoctrine()->getRepository('ProductosManagerBundle:PalabrasClaveProducto')
                ->findBy(array('idProducto' => $producto));
        
        $return = array();
        
        foreach($query as $q)
            array_push($return, $q->getPalabra());
        
        return $return;
    }
    
    public function getProductImages(Producto $producto){
        $query = $this->getDoctrine()->getRepository('ProductosManagerBundle:ProductoImagenes')
                ->findBy(array('idProducto' => $producto));
        
        $return = array();
        
        foreach($query as $q){
            $imagen = \Application\GenericoBundle\ApplicationGenericoBundle::file_to_base64($q->getRutaImagen());
            array_push($return, $imagen);            
        }
        
        return $return;
    }
}
