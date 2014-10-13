<?php

namespace Productos\CreacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Productos\ManagerBundle\Entity\Producto;
use Productos\ManagerBundle\Entity\PalabrasClaveProducto;
use Productos\ManagerBundle\Entity\ProductoImagenes;
use Doctrine\ORM\ORMException;
use Application\GenericoBundle\ApplicationGenericoBundle;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProductosCreacionBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function crearAction(){
        $request = $this->get('request'); 
        $response = new JsonResponse();
        
        if($request->getMethod()=='POST'){  
            //$data = json_decode(file_get_contents('php://input'), true);
            
            $data = $this->get('request')->request->all();
            
            $this->parsePost($data);
            
            $name = $data['name'];
            $description = $data['description'];
            $price = $data['price'];
            $category = (!empty($data['category'])) ? $data['category'] : null;
            $keywords = (!empty($data['keywords'])) ? $data['keywords'] : null;//Must be array
            $images = (!empty($data['images'])) ? $data['images'] : null; //Must be array of BASE64
            $idusuario = $data['idusuario'];
            
            $estado_producto = $this->getDoctrine()->getRepository('ProductosManagerBundle:EstadosProducto')
                    ->findBy(array(), array('id' => 'ASC'))[0];
            
            $usuario = $this->getDoctrine()->getRepository('ProductosManagerBundle:Usuarios')->find($idusuario);

            $product = new Producto();
            $product->setNombre($name);
            if(!is_null($description)) $product->setDescripcion($description);
            $product->setPrecio($price);            
            $product->setIdEstado($estado_producto);
            $product->setFechaPublicacion(new \DateTime('now'));
            $product->setActivo(true);
            
            $product->setIdUsuario($usuario);
            //$product->set
            if(!is_null($category)){
                $category = $this->getDoctrine()->getRepository('ProductosManagerBundle:CategoriaProducto')->findOneBy(array('id' => $category));
                $product->setIdCategoria($category);
            }
            
            try{
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();                
            } catch(ORMException $ex) {
                $errorResponse = new JsonResponse();
                $errorResponse->setStatusCode(500);
                $errorResponse->setData(array('error' => 'An error ocurred while creating product register', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));
                
                return $errorResponse;
                exit;
            }
            
            if(!is_null($keywords) && sizeof($keywords)>0)
                $this->processKeyWords ($keyWords, $product);
            
            if(!is_null($images) && sizeof($images)>0)
                $this->processImages ($images, $product);
            
            
        } else {
            $response->setData(array('error' => 'ONLY POST METHOD ALLOWED'));
            $response->setStatusCode(500);
            return $response;
        }
        
        $response->setData(array('result' => true,'message' => 'Product successfully created', 'id' => $product->getId()));
        $response->setStatusCode(200);
        return $response;
        
    }
    
    public function parsePost($data){
        $badParseResponse = new JsonResponse();
        $badParseResponse->setStatusCode(500);
        if(is_null($data['name']) || empty($data['name'])){
            $badParseResponse->setData(array('error' => 'missing input parameter', 'details' => '"NAME" parameter is missing or empty'));
            $badParseResponse->send();
            exit;
        } else if (is_null($data['price']) || empty($data['price'])) {
            $badParseResponse->setData(array('error' => 'missing input parameter', 'details' => '"PRICE" parameter is missing or empty'));
            $badParseResponse->send();
            exit;
        } else {
            return true;
        }
    }
    
    public function processImages(Array &$images, Producto &$product){
        if(!is_dir($this->container->getParameter('product_images_folder')))
            mkdir($this->container->getParameter('product_images_folder'), 0777);
        
        foreach ($images as $i) {
            $fileName = self::RandomString().".png";
            $file = $this->container->getParameter('product_images_folder').$fileName;
            //echo $i; exit;
            self::base64_to_file($i, $file);
            
            $imagen = new ProductoImagenes();
            $imagen->setIdProducto($product);
            $imagen->setNombreImagen($fileName);
            $imagen->setRutaImagen($file);
            
            try{
                $em = $this->getDoctrine()->getManager();
                $em->persist($imagen);
                $em->flush();                
            } catch(ORMException $ex) {
                $errorResponse = new JsonResponse();
                $errorResponse->setStatusCode(500);
                $errorResponse->setData(array('error' => 'An error ocurred while inserting product image', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));
                $errorResponse->send();
                
                exit;
            }
        }
    }
    
    public static function RandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 20; $i++)
            $randstring .= $characters[rand(0, strlen($characters))];

        return $randstring;
    }
    
    public static function base64_to_file($base64, $outputFile) {
        $data = explode(',', $base64);

        //$base64_string = $data[1];
        $base64_string = $base64;
        $file = fopen($outputFile, "wb");
        fwrite($file, base64_decode($base64_string));
        fclose($file);
    }
    
    public function processKeyWords(Array &$keyWords, Producto &$product){
        foreach ($keyWords as $k) {
            $keyword = new PalabrasClaveProducto();
            $keyword->setPalabra($k);
            $keyword->setIdProducto($product);
            
            try{
                $em = $this->getDoctrine()->getManager();
                $em->persist($keyword);
                $em->flush();                
            } catch(ORMException $ex) {
                $errorResponse = new JsonResponse();
                $errorResponse->setStatusCode(500);
                $errorResponse->setData(array('error' => 'An error ocurred while inserting product keyword', 'details' => $ex->getMessage(), 'code' => $ex->getCode()));
                $errorResponse->send();
                break;
            }
            
        }
    }
}
