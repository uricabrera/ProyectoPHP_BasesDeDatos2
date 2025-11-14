<?php
include "./../Backend/conexionBD.php";

session_start();

if ($_SESSION['tipo_de_usuario'] != 1) {
    header('location:../login.php');
}

if (isset($_POST["nombre"]) && isset($_POST["telefono"]) && isset($_POST["gmail"])){

    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $gmail= $_POST["gmail"];

    $consulta = "INSERT INTO proveedor(nombre, telefono, correo) VALUES ('$nombre','$telefono','$gmail')";

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
