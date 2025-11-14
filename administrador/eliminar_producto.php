<?php 
    session_start();
    include "./../Backend/conexionBD.php";
    if ($_SESSION['tipo_de_usuario'] != 1) {
        header('location:../login.php');
    }

    $id_prenda = $_GET['prenda_id'];

    $consulta = "DELETE FROM prenda WHERE id_prenda = {$id_prenda}";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location:../productos.php');
    exit(); 
?>