<?php
require_once 'libs/router.php';
require_once 'app/controllers/productController.php';

$router = new Router();



//               endpoint         |  verbo    |     controller         |    método
$router->addRoute('product'      ,   'GET'    ,  'ProductController'  , 'getAllProducts');
$router->addRoute('product/:id'  ,   'GET'    ,  'ProductController'  , 'getProduct'    );
$router->addRoute('product'      ,   'POST'   ,  'ProductController'  , 'newProduct'    );
$router->addRoute('product/:id'  ,   'DELETE' ,  'ProductController'  , 'deleteProduct');
$router->addRoute('product/:id'  ,   'PUT'    ,  'ProductController'  , 'updateProduct');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
?>