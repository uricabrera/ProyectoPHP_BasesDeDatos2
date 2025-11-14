<?php
include "./../Backend/conexionBD.php";


session_start();
if ($_SESSION['tipo_de_usuario'] != 1) {
    header('location:../login.php');
}

if (isset($_POST["nombre"]) && isset($_POST["descripcion"])) {

    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    
    $consulta = "INSERT INTO marca(nombre, descripcion) VALUES ('$nombre','$descripcion')";

    $resultado = mysqli_query($conexion, $consulta);


    if ($resultado) {
        header('Location: administrador.php');
        exit();
    } else {
        echo "<h2>error al agregar proveedor</h2>";
    }
} else {
    echo "<h2>No se inserto bien los requisitos para la prenda</h2>";
}
