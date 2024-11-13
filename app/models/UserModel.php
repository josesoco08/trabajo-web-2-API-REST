<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=tpe_web_2;charset=utf8', 'root', '');
    }
 public function getUserByUsername($username) {    
    $query = $this->db->prepare("SELECT * FROM usuario WHERE username = ?");
    $query->execute([$username]);

    $usuario = $query->fetch(PDO::FETCH_OBJ);

    return $usuario;
}
}

