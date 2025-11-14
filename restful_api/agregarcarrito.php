<?php
session_start();
include './../Backend/conexionBD.php';

$id_prenda = $_POST['id'];
$cantidad_prenda = $_POST['cantidad'];

if($cantidad_prenda <= 0){
    exit();
}

$prenda = array('id' => $id_prenda, 'cantidad' => $cantidad_prenda);

if(isset($_SESSION['carrito'])){
    for($i=0;$i<count($_SESSION['carrito']);$i++){
        if($prenda['id'] == $_SESSION['carrito'][$i]['id']){
            $_SESSION['carrito'][$i]['id'] = $prenda['id'];
            $_SESSION['carrito'][$i]['cantidad'] = $prenda['cantidad'];
            exit();
        }
    }
    array_push($_SESSION['carrito'],$prenda);
}
else{
    $_SESSION['carrito'] = array();
    array_push($_SESSION['carrito'],$prenda);
}

echo var_dump($_SESSION['carrito']);

?>