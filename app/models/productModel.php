<?php
class ProductModel{
    private $db;
    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=tpe_web_2;charset=utf8', 'root', '');        
    }

    function getAllModel(){
        $query= $this->db->prepare('SELECT * FROM productos');
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }
    function getModel($id){
        $query= $this->db->prepare('SELECT * FROM producto WHERE id_producto = ?');
        $query->execute([$id]);
        $product = $query->fetch(PDO::FETCH_OBJ);
        return $product;
    } 
    function insertProduct($Nombre_producto, $id_proveedor_fk, $categoria, $cantidad, $talle, $valor){
        $query = $this->db->prepare('INSERT INTO producto(Nombre_producto, id_proveedor_fk, categoria, cantidad, talle, valor) VALUE(?, ?, ?, ?, ?, ?)');
        $query->execute([$Nombre_producto, $id_proveedor_fk, $categoria, $cantidad, $talle, $valor]);
        $id = $this->db->lastInsertId();
        return $id;
    }
    function deleteModel($id){
        $query= $this->db->prepare('DELETE FROM producto  WHERE id_producto=?');
        $query->execute([$id]);
    }
    function updateModel($id, $Nombre_producto, $id_proveedor_fk, $categoria, $cantidad, $talle, $valor) {
        $query = $this->db->prepare(' UPDATE producto 
                                      SET Nombre_producto = ?, id_proveedor_fk = ?, categoria = ?, cantidad = ?, talle = ?, valor = ? 
                                       WHERE id_producto = ? ');
        $query->execute([$Nombre_producto, $id_proveedor_fk, $categoria, $cantidad, $talle, $valor, $id]);
    }

}
?>    

