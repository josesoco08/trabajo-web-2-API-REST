<?php
require_once 'libs/router.php';
require_once 'app/controllers/ProductController.php';
require_once 'app/middlewares/jwt.middlewares.php';
require_once 'app/controllers/UserController.php';
$router = new Router();
$router->addMiddleware(new JWTAuthMiddleware());

// Rutas sin autenticación

//                  endpoint         |  verbo    |     controller         |    método
$router->addRoute('product'          ,   'GET'   , 'ProductController'    , 'getAllProducts');
$router->addRoute('product/:id'      ,   'GET'   , 'ProductController'    , 'getProduct');
$router->addRoute('usuarios/token'   ,   'GET'   , 'UserApiController'    , 'getToken');

// Rutas con autenticación (el middleware se ejecutará en todas estas rutas)
//                  endpoint         |  verbo    |     controller         |    método
$router->addRoute('product'          ,   'POST'  , 'ProductController'    , 'newProduct');
$router->addRoute('product/:id'      ,   'PUT'   , 'ProductController'    , 'updateProduct');
$router->addRoute('product/:id'      , 'DELETE'  , 'ProductController'    , 'deleteProduct');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
