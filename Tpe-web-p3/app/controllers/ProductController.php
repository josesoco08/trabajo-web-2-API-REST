<?php
require_once './app/models/ProductModel.php';
require_once './app/views/JSONview.php';

class ProductController {
    private $model;
    private $view;
    
    public function __construct() {
        $this->model = new ProductModel;
        $this->view = new JSONview;
    }
    function getAllProducts($res, $req) {
        $filtrado = null;
        $valor = null;
        $sort = 'id_producto';
        $order = 'ASC';
    
        if (isset($req->query->filtro)) {
            $filtrado = $req->query->filtro;
        }
        if (isset($req->query->valor)) {
            $valor = $req->query->valor;
        }
        if (isset($req->query->sort)) {
            $sort = $req->query->sort;
        }
        if (isset($req->query->order) && strtoupper($req->query->order) === 'DESC') {
            $order = 'DESC';
        }
    
        $products = $this->model->getAllModel($filtrado, $valor, $sort, $order);
    
        if (!$products) {
            return $this->view->response("No hay productos disponibles", 404);
        }
    
        return $this->view->response($products);
    }

    function getProduct($res, $req) {
        $id = $req->params->id;
        $product = $this->model->getModel($id);
        
        if (!$product) {
            return $this->view->response("No se encontró producto con id=$id", 404);
        }

        return $this->view->response($product, 200);
    }

    function newProduct($res, $req) {
       
        if (empty($req->body->Nombre_producto) || empty($req->body->id_proveedor_fk) || 
            empty($req->body->categoria) || empty($req->body->cantidad) || 
            empty($req->body->talle) || empty($req->body->valor)) {
            return $this->view->response("Faltan completar datos", 400);
        }

        

        $id = $this->model->insertProduct(
            $req->body->Nombre_producto,
            $req->body->id_proveedor_fk,
            $req->body->categoria,
            $req->body->cantidad,
            $req->body->talle,
            $req->body->valor,
           
        );

        if ($id) {
            return $this->view->response("El producto se ha creado con éxito, con el id=$id", 201);
        } else {
            return $this->view->response("Error al crear el producto", 400);
        }
    }

 
    function deleteProduct($res, $req) {
        $id = $req->params->id;
        $product = $this->model->getModel($id);

        if (!$product) {
            return $this->view->response("No se encontró producto con id=$id", 404);
        }

        $this->model->deleteModel($id);
        return $this->view->response("Se eliminó el producto con el id=$id", 200);
    }

    function updateProduct($res, $req) {
        $id = $req->params->id;
        $product = $this->model->getModel($id);

        if (!$product) {
            return $this->view->response("El producto con el id=$id no existe", 404);
        }

          if (empty($req->body->Nombre_producto) || empty($req->body->id_proveedor_fk) || 
            empty($req->body->categoria) || empty($req->body->cantidad) || 
            empty($req->body->talle) || empty($req->body->valor)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        $Nombre_producto = $req->body->Nombre_producto;
        $id_proveedor_fk = $req->body->id_proveedor_fk;
        $categoria = $req->body->categoria;
        $cantidad = $req->body->cantidad;
        $talle = $req->body->talle;
        $valor = $req->body->valor;
   

        $this->model->updateModel($id, $Nombre_producto, $id_proveedor_fk, $categoria, $cantidad, $talle, $valor,);


        $product = $this->model->getModel($id);
        return $this->view->response($product, 200);
    }

   
}
?>
