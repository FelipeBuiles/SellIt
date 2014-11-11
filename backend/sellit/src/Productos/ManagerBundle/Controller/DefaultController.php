<?php

namespace Productos\ManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Productos\ManagerBundle\Entity\Producto;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('ProductosManagerBundle:Default:index.html.twig', array('name' => $name));
    }

    public function verAction($idproducto) {
        $request = $this->get('request');
        $response = new JsonResponse();

        if ($request->getMethod() == 'GET') {
            if (!is_null($idproducto) && !empty($idproducto)) {

                $query = $this->getDoctrine()->getRepository('ProductosManagerBundle:Producto')->findOneBy(array('id' => $idproducto));

                if (!is_null($query->getIdCategoria())) {
                    $categoria = $query->getIdCategoria()->getCategoria();
                } else {
                    $categoria = null;
                }


                if (!is_null($query->getIdCategoria()))
                    $categoria = $query->getIdCategoria()->getCategoria();

                if (!is_null($query)) {
                    $json = array(
                        'id' => $query->getId(),
                        'nombre' => $query->getNombre(),
                        'descripcion' => $query->getDescripcion(),
                        'estado' => $query->getIdEstado()->getEstado(),
                        'precio' => $query->getPrecio(),
                        'categoria' => $categoria,
                        'fecha_publicacion' => $query->getFechaPublicacion(),
                        'keywords' => $this->getProductKeywords($query),
                        'images' => $this->getProductImages($query),
                        'id_usuario' => array('name' => $query->getIdUsuario()->getNombre(),
                            'ruta_avatar' => $query->getIdUsuario()->getRutaAvatar(),
                            'id_front' => $query->getIdUsuario()->getIdFront())
                    );

                    $response->setData($json);
                    $response->setStatusCode(200);
                    return $response;
                } else {
                    $response->setData(array("error" => "The product " . $idproducto . " doesnt exists"));
                    $response->setStatusCode(404);
                    return $response;
                }
            } else {
                $response->setData(array("error" => "IDPRODUCTO cant be null or empty"));
                $response->setStatusCode(200);
                return $response;
            }
        } else {
            $response->setData(array('error' => 'ONLY GET METHOD ALLOWED'));
            $response->setStatusCode(200);
            return $response;
        }
    }

    public function listarvendedorAction($idvendedor, $limit, $offset, $include_images, $orderASC) {
        $request = $this->get('request');
        $response = new JsonResponse();

        $id_vendedores = array();

        if ($idvendedor != "false") {
            $vendedor = $this->getDoctrine()->getRepository('ProductosManagerBundle:Usuarios')->findOneBy(array('idFront' => $idvendedor));

            if (is_null($vendedor))
                $this->sendErrorMsg("Vendedor doesnt exists");

            array_push($id_vendedores, $vendedor->getId());
        } else {
            $vendedor = $this->getDoctrine()->getRepository('ProductosManagerBundle:Usuarios')->findAll();

            foreach ($vendedor as $v)
                array_push($id_vendedores, $v->getId());
        }


        $sql = "SELECT id AS producto "
                . "FROM producto p "
                . "WHERE p.id_usuario IN (" . implode(',', $id_vendedores) . ") "
                . "ORDER BY p.fecha_publicacion " . strtoupper($orderASC) . " "
                . "LIMIT " . $limit . " "
                . "OFFSET " . $offset;

        $query = $this->getDoctrine()->getEntityManager()
                ->getConnection()
                ->prepare($sql);

        $query->execute();
        $rows = $query->fetchAll();

        $json = array();
        foreach ($rows AS $r) {
            $producto = $this->getDoctrine()->getRepository('ProductosManagerBundle:Producto')->find($r['producto']);

            $categoria = (!is_null($producto->getIdCategoria())) ? $producto->getIdCategoria()->getCategoria() : null;

            if ($include_images == true) {
                $json_child = array(
                    'id' => $producto->getId(),
                    'nombre' => $producto->getNombre(),
                    'descripcion' => $producto->getDescripcion(),
                    'estado' => $producto->getIdEstado()->getEstado(),
                    'precio' => $producto->getPrecio(),
                    'categoria' => $categoria,
                    'fecha_publicacion' => $producto->getFechaPublicacion(),
                    'keywords' => $this->getProductKeywords($producto),
                    'images' => $this->getProductImages($producto),
                    'usuario' => array(
                        'id' => $producto->getIdUsuario()->getId(),
                        'nombre' => $producto->getIdUsuario()->getNombre(),
                        'ruta_avatar' => $producto->getIdUsuario()->getRutaAvatar()
                    ),
                );
            } else {
                $json_child = array(
                    'id' => $producto->getId(),
                    'nombre' => $producto->getNombre(),
                    'descripcion' => $producto->getDescripcion(),
                    'estado' => $producto->getIdEstado()->getEstado(),
                    'precio' => $producto->getPrecio(),
                    'categoria' => $categoria,
                    'fecha_publicacion' => $producto->getFechaPublicacion(),
                    'keywords' => $this->getProductKeywords($producto),
                    'usuario' => array(
                        'id' => $producto->getIdUsuario()->getId(),
                        'nombre' => $producto->getIdUsuario()->getNombre(),
                        'ruta_avatar' => $producto->getIdUsuario()->getRutaAvatar()
                    ),
                );
            }

            array_push($json, $json_child);
        }

        /* if (!is_null($vendedor)) {
          $json = array();

          /*    $products = $this->getDoctrine()->getEntityManager()->createQueryBuilder()
          ->from('ProductosManagerBundle:Producto', 's')
          ->where('s.idUsuario IN (:usuarios)')
          ->setParameter('usuarios', $alterArr)
          ->getQuery()
          ->setMaxResults($limit)
          ->setFirstResult($offset)
          ->getResult();

          var_dump($products); exit; 

        if (is_array($vendedor)) {
            foreach ($vendedor as $v) {
                if ($orderASC == "true") {
                    $productos = $this->getDoctrine()->getRepository('ProductosManagerBundle:Producto')
                            ->findBy(array('idUsuario' => $v->getId()), array('id' => 'ASC'), $limit, $offset);
                } else {
                    $productos = $this->getDoctrine()->getRepository('ProductosManagerBundle:Producto')
                            ->findBy(array('idUsuario' => $v->getId()), array('id' => 'DESC'), $limit, $offset);
                }

                if (!is_null($productos)) {

                    foreach ($productos as $p) {
                        if (!is_null($p->getIdCategoria())) {
                            $categoria = $p->getIdCategoria()->getCategoria();
                        } else {
                            $categoria = null;
                        }


                        if ($include_images == true) {
                            $json_child = array(
                                'id' => $p->getId(),
                                'nombre' => $p->getNombre(),
                                'descripcion' => $p->getDescripcion(),
                                'estado' => $p->getIdEstado()->getEstado(),
                                'precio' => $p->getPrecio(),
                                'categoria' => $categoria,
                                'fecha_publicacion' => $p->getFechaPublicacion(),
                                'keywords' => $this->getProductKeywords($p),
                                'images' => $this->getProductImages($p),
                                'usuario' => array(
                                    'id' => $p->getIdUsuario()->getId(),
                                    'nombre' => $p->getIdUsuario()->getNombre(),
                                    'ruta_avatar' => $p->getIdUsuario()->getRutaAvatar()
                                ),
                            );
                        } else {
                            $json_child = array(
                                'id' => $p->getId(),
                                'nombre' => $p->getNombre(),
                                'descripcion' => $p->getDescripcion(),
                                'estado' => $p->getIdEstado()->getEstado(),
                                'precio' => $p->getPrecio(),
                                'categoria' => $categoria,
                                'fecha_publicacion' => $p->getFechaPublicacion(),
                                'keywords' => $this->getProductKeywords($p),
                                'usuario' => array(
                                    'id' => $p->getIdUsuario()->getId(),
                                    'nombre' => $p->getIdUsuario()->getNombre(),
                                    'ruta_avatar' => $p->getIdUsuario()->getRutaAvatar()
                                ),
                            );
                        }

                        array_push($json, $json_child);
                    }
                }
            }
        } else {
            if ($orderASC) {
                $productos = $this->getDoctrine()->getRepository('ProductosManagerBundle:Producto')
                        ->findBy(array('idUsuario' => $vendedor->getId()), array('id' => 'ASC'), $limit, $offset);
            } else {
                $productos = $this->getDoctrine()->getRepository('ProductosManagerBundle:Producto')
                        ->findBy(array('idUsuario' => $vendedor->getId()), array('id' => 'DESC'), $limit, $offset);
            }

            if (!is_null($productos)) {

                foreach ($productos as $p) {
                    if (!is_null($p->getIdCategoria())) {
                        $categoria = $p->getIdCategoria()->getCategoria();
                    } else {
                        $categoria = null;
                    }


                    if ($include_images == true) {
                        $json_child = array(
                            'id' => $p->getId(),
                            'nombre' => $p->getNombre(),
                            'descripcion' => $p->getDescripcion(),
                            'estado' => $p->getIdEstado()->getEstado(),
                            'precio' => $p->getPrecio(),
                            'categoria' => $categoria,
                            'fecha_publicacion' => $p->getFechaPublicacion(),
                            'keywords' => $this->getProductKeywords($p),
                            'images' => $this->getProductImages($p),
                            'usuario' => array(
                                'id' => $p->getIdUsuario()->getId(),
                                'nombre' => $p->getIdUsuario()->getNombre(),
                                'ruta_avatar' => $p->getIdUsuario()->getRutaAvatar()
                            ),
                        );
                    } else {
                        $json_child = array(
                            'id' => $p->getId(),
                            'nombre' => $p->getNombre(),
                            'descripcion' => $p->getDescripcion(),
                            'estado' => $p->getIdEstado()->getEstado(),
                            'precio' => $p->getPrecio(),
                            'categoria' => $categoria,
                            'fecha_publicacion' => $p->getFechaPublicacion(),
                            'keywords' => $this->getProductKeywords($p),
                            'usuario' => array(
                                'id' => $p->getIdUsuario()->getId(),
                                'nombre' => $p->getIdUsuario()->getNombre(),
                                'ruta_avatar' => $p->getIdUsuario()->getRutaAvatar()
                            ),
                        );
                    }

                    array_push($json, $json_child);
                }
            }
        }
        } else {
        $response->setData(array("error" => "No products to be displayed"));
        $response->setStatusCode(404);
        return $response;
        }*/

        $response->setData($json);
        $response->setStatusCode(200);
        return $response;
    }

    public function listarcategoriasAction() {
        $request = $this->get('request');
        $response = new JsonResponse();

        if ($request->getMethod() == 'GET') {
            $categorias = $this->getDoctrine()->getRepository('ProductosManagerBundle:CategoriaProducto')
                    ->findBy(array(), array('categoria' => 'ASC'));

            $json = array();

            foreach ($categorias as $c) {
                $json_child = array('id' => $c->getId(), 'nombre' => $c->getCategoria());
                array_push($json, $json_child);
            }
        } else {
            $response->setData(array('error' => 'ONLY GET METHOD ALLOWED'));
            $response->setStatusCode(200);
            return $response;
        }

        $response->setData($json);
        $response->setStatusCode(200);
        return $response;
    }

    public function getProductKeywords(Producto $producto) {
        $query = $this->getDoctrine()->getRepository('ProductosManagerBundle:PalabrasClaveProducto')
                ->findBy(array('idProducto' => $producto));

        $return = array();

        foreach ($query as $q)
            array_push($return, $q->getPalabra());

        return $return;
    }

    public function getProductImages(Producto $producto) {
        $query = $this->getDoctrine()->getRepository('ProductosManagerBundle:ProductoImagenes')
                ->findBy(array('idProducto' => $producto));

        $return = array();

        foreach ($query as $q) {
            $imagen = self::file_to_base64($q->getRutaImagen());
            array_push($return, $imagen);
        }

        return $return;
    }

    public static function file_to_base64($inputFile) {

        if (is_file($inputFile)) {
            try {
                $content = file_get_contents($inputFile);
            } catch (Symfony\Component\HttpKernel\Exception $ex) {
                echo $ex->getMessage();
                exit;
            }

            return base64_encode($content);
        } else {
            return null;
        }
    }

    public function contarProductosAction($idVendedor) {
        if (!is_null($idVendedor)) {
            $idusuario = $this->getDoctrine()->getRepository('ProductosManagerBundle:Usuarios')
                    ->findOneBy(array('idFront' => $idVendedor));

            if (!is_null($idusuario)) {
                $idusuario = $idusuario->getId();
            } else {
                $request = $this->get('request');
                $response = new JsonResponse();
                $response->setData(array('error' => "The requested user doesnt exists"));
                $response->setStatusCode(200);
                $response->send();
                exit;
            }

            $sql = "SELECT count(0) AS cuenta FROM producto WHERE id_usuario = " . $idusuario;
        } else {
            $sql = "SELECT count(0) AS cuenta FROM producto";
        }

        $query = $this->getDoctrine()->getEntityManager()->getConnection()->prepare($sql);
        $query->execute();


        $request = $this->get('request');
        $response = new JsonResponse();
        $response->setData(array('total' => $query->fetchAll()[0]['cuenta']));
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
