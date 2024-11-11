<?php
require_once 'app/models/productModel.php';
require_once 'app/views/JSONview.php';
class ProductController {
    private $model;
    private $view;
    public function __construct()
    {
        $this->model = new ProductModel;
        $this->view = new JSONview;
    }
    function getAllProducts($res, $req){
        $products = $this->model->getAllModel();       
        if(!$products){
        return  $this->view->response("no hay productos disponibles" );
       }
       return $this->view->response($products);
    }
    function getProduct($res, $req){
        $id =$req->params->id;
        $product = $this->model->getModel($id);
        if (!$product) {
            return $this->view->response("No se encontró producto con id=$id", 404);
        }
        return $this->view->response($product);
    }
    function newProduct($res, $req){
        if(empty($req->body->Nombre_producto) && empty($res->body->id_proveedor_fk) && empty($res->body->categoria) && empty($res->body->cantidad) && empty($res->body->talle) && empty($res->body->valor) && empty($res->body->imagen)){
            return $this->view->response("faltan completar datos", 400);
        } 
        $Nombre_producto = $req->body->Nombre_producto;
        $id_proveedor_fk = $req->body->id_proveedor_fk;
        $categoria = $req->body->categoria;
        $cantidad = $req->body->cantidad;
        $talle = $req->body->talle;
        $valor = $req->body->valor;

        $id = $this->model->insertProduct($Nombre_producto, $id_proveedor_fk, $categoria, $cantidad, $talle, $valor);
        if($id){
            return $this->view->response("el boleto se ha creado con exito, con el id=$id", 200);
        }
    }
    function deleteProduct($res, $req){
        $id =$req->params->id;
        $product= $this->model->getModel($id);

        if(!$product){
            return $this->view->response("no se encontro producto con id=$id", 404);
        }
        $this->model->deleteModel($id);
        $this->view->response("se elimino producto con el id=$id", 200);
    }

    function updateProduct($res, $req) {
        $id = $req->params->id;
    
        $product = $this->model->getModel($id);
        if (!$product) {
            return $this->view->response("El producto con el id=$id no existe", 404);
        }
        // Validar que los datos 
        if (!isset($req->body->Nombre_producto) || empty($req->body->Nombre_producto) ||
            !isset($req->body->id_proveedor_fk) || empty($req->body->id_proveedor_fk) ||
            !isset($req->body->categoria) || empty($req->body->categoria) ||
            !isset($req->body->cantidad) || empty($req->body->cantidad) ||
            !isset($req->body->talle) || empty($req->body->talle) ||
            !isset($req->body->valor) || empty($req->body->valor)) {
            return $this->view->response('Faltan completar datos', 400);
        }
    
        $Nombre_producto = $req->body->Nombre_producto;
        $id_proveedor_fk = $req->body->id_proveedor_fk;
        $categoria = $req->body->categoria;
        $cantidad = $req->body->cantidad;
        $talle = $req->body->talle;
        $valor = $req->body->valor;
    
        $this->model->updateModel($id, $Nombre_producto, $id_proveedor_fk, $categoria, $cantidad, $talle, $valor);
    
        $product = $this->model->getModel($id);
        return $this->view->response($product, 200);
    }
}
?>