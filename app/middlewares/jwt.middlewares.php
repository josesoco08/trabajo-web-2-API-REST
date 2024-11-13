<?php
    class JWTAuthMiddleware {
        public function run($req, $res) {
            if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
                return (new JSONview())->response("Token requerido", 401);
            }
    
            $auth_header = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);
            if (count($auth_header) != 2 || $auth_header[0] != 'Bearer') {
                return (new JSONview())->response("Formato de token incorrecto", 400);
            }
    
            $jwt = $auth_header[1];
            $user = validateJWT($jwt);
    
            if (!$user) {
                return (new JSONview())->response("Token inválido o expirado", 401);
            }
            $req->user = $user;
        }
    }