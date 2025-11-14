<?php
//hacer con ajax el agregado del producto 
include './../Backend/conexionBD.php';
$consulta = "SELECT * FROM prenda";
$resultado_produtos = mysqli_query($conexion, $consulta);

$array_productos = [];

session_start();

while($fila = $resultado_produtos->fetch_assoc()){
    $id_prenda = $fila['id_prenda'];
    $id_marca = $fila['id_marca'];
    $id_proveedor = $fila['id_proveedor'];
    $nombre = $fila['nombre'];
    $descripcion = $fila['descripcion'];
    $color = $fila['color'];
    $talle = $fila['talle'];
    $imagen = $fila['imagen'];
    $cantidad = $fila['cantidad'];
    $isAdmin;


    if(isset($_SESSION['tipo_de_usuario'])){
        if($_SESSION['tipo_de_usuario'] == 1){
            $isAdmin = 1;
        }
        else{
            $isAdmin = 0;
        }
    }
    else{
        $isAdmin = 2;
    }

    


    $precio = $fila['precio'];

    $prenda_assoc = [
        "id_prenda" => $id_prenda,
        "id_marca" => $id_marca,
        "id_proveedor" => $id_proveedor,
        "nombre" => $nombre,
        "descripcion" => $descripcion,
        "color" => $color,
        "talle" => $talle,
        "imagen" => $imagen,
        "cantidad" => $cantidad,
        "precio" => $precio,
        "isAdmin" => $isAdmin
    ];

    array_push($array_productos, $prenda_assoc);
}



$array_final = json_encode($array_productos, JSON_UNESCAPED_SLASHES);

echo $array_final;

?>