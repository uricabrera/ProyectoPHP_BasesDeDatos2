<?php
include "./../Backend/conexionBD.php";

if(isset($_POST['subir'])){ 
//(isset($_POST["nombre"]) && isset($_POST["descripcion"]) && isset($_POST["talla"]) && isset($_POST["color"]) && isset($_FILES["imagen"]) && isset($_POST["precio"])){
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $tallas = $_POST["talla"];
    $color = $_POST["color"];
    $id_proveedor = $_POST["proveedor"];
    $id_marca = $_POST["marca"];
    $imagen = $_FILES['imagen']['name'].rand(1,1000); //se usa FILES en vez de POST ya que es un archivo lo que se guarda
    $imagen_tmp = $_FILES['imagen']['tmp_name']; // Obtener la ubicación temporal del archivo
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["precio"];

    // Mover el archivo de imagen al directorio deseado
    $directorio_destino = './../img/productos_img/'.$imagen;

    mysqli_begin_transaction($conexion);

    try{

        if(isset($id_marca) && isset($id_proveedor)){

            $consulta = "UPDATE prenda SET id_marca='$id_marca',id_proveedor='$id_proveedor',nombre='$nombre',descripcion='$descripcion',color='$color',talle='$tallas',cantidad='$cantidad',imagen='$imagen',precio='$precio' WHERE id_prenda = {$_GET['id_prenda']}";

            $resultado = mysqli_query($conexion, $consulta);
        } 
        mysqli_commit($conexion);
    }catch(mysqli_sql_exception $exception){
        mysqli_rollback($conexion);
        throw $exception;
    }

    

    if ($resultado){
        /*move_uploaded_file(): Esta función de PHP toma dos argumentos: la ubicación temporal del archivo ($_FILES["imagen"]["tmp_name"]) y la ubicación final donde deseas mover el archivo (la ruta completa formada por $directorio_destino . $imagen). La función se encarga de mover físicamente el archivo desde su ubicación temporal a la ubicación definitiva que especificaste.*/
        move_uploaded_file($imagen_tmp, $directorio_destino);
        header('Location: administrador.php');
        exit();
    } else {
        echo "<h2>error al agregar prenda</h2>";
    }
} else {
    echo "<h2>No se inserto bien los requisitos para la prenda</h2>";
}

?>