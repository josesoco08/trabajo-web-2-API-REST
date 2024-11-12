<?php
class ProductModel{
    private $db;
    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=tpe_web_2;charset=utf8', 'root', '');        
    }
    function getAllModel($filtrado = null, $valor = null) {
        $sql = 'SELECT * FROM producto';
    
        // Si se pasa un filtro, aplicamos el 'WHERE'
        if ($filtrado) {
            $sql .= ' WHERE ' . $filtrado . ' = ?';
        }
    
            $query = $this->db->prepare($sql);
            if ($valor !== null ||  $filtrado !== null) {
                $query->execute([$valor]);
            }else{        
                $query->execute([]);
            }
    
            $products = $query->fetchAll(PDO::FETCH_OBJ);
            return $products;
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

