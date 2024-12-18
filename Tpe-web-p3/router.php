<?php

require_once 'libs/router.php';
require_once 'app/controllers/ProductController.php';
requiere_once 'app/middlewares.php';

// base_url para direcciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');


$router = new Router();
$router->addMiddleware(new JWTAuthMiddleware());
// Rutas sin autenticación

//                  endpoint         |  verbo    |     controller         |    método
$router->addRoute('product'          ,   'GET'   , 'ProductController'    , 'getAllProducts');
$router->addRoute('product/:id'      ,   'GET'   , 'ProductController'    , 'getProduct');
$router->addRoute('product'          ,   'POST'  , 'ProductController'    , 'newProduct');
$router->addRoute('product/:id'      ,   'PUT'   , 'ProductController'    , 'updateProduct');
$router->addRoute('product/:id'      , 'DELETE'  , 'ProductController'    , 'deleteProduct');
$router->addRoute('usuarios/token', 'GET','UserApiController','getToken');
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);