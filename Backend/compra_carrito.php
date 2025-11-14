<?php
session_start();

if (isset($_POST['hacer_compra'])) {
    // Conexión a la base de datos
    include 'conexionBD.php';

    // Variables para almacenar los datos de la compra
    $usuarioId = $_SESSION['id_usuario']; // Suponiendo que el ID del usuario está almacenado en la sesión
    $fechaCompra = date('Y-m-d H:i:s');
    $dia = date("Ymd");
    $valuerandom = strtoupper(substr(uniqid(sha1(time())), 0, 4));
    $valororden = $dia . $valuerandom;

    // Deshabilitar el autocommit
    $conexion->autocommit(FALSE);

    $insercionesExitosas = true;

    // Recorrer el carrito y preparar los datos para la inserción
    foreach ($_SESSION['carrito'] as $item) {
        $prendaId = $item['id'];
        $cantidad = $item['cantidad'];

        // Insertar en la tabla carrito
        $consulta = "INSERT INTO carrito (id_usuario, id_prenda, cantidad, id_orden) VALUES ($usuarioId, $prendaId, $cantidad, '$valororden')";
        $resultado = mysqli_query($conexion, $consulta);

        if (!$resultado) {
            $insercionesExitosas = false;
            break; // Salir del bucle si hay un error
        }

        // Actualizar el stock en la tabla prenda
        $consultaStock = "
            UPDATE prenda 
            INNER JOIN carrito ON prenda.id_prenda = carrito.id_prenda
            SET prenda.cantidad = prenda.cantidad - $cantidad
            WHERE prenda.id_prenda = $prendaId AND prenda.cantidad >= $cantidad";

        $resultadoStock = mysqli_query($conexion, $consultaStock);

        if (!$resultadoStock || mysqli_affected_rows($conexion) == 0) {
            $insercionesExitosas = false;
            break; // Salir del bucle si hay un error o no hay suficiente stock
        }
    }

    if ($insercionesExitosas) {
        $conexion->commit(); // Confirmar la transacción

        // Vaciar el carrito
        $_SESSION['carrito'] = [];
        // Redirigir de vuelta al carrito con un mensaje de éxito
        header("Location: ./../carrito.php?compra=exitosa");
    } else {
        $conexion->rollback(); // Revertir la transacción
        // Manejar el error, redirigir con un mensaje de error o mostrar un mensaje
        header("Location: ./../carrito.php?compra=fallida");
    }

    // Habilitar el autocommit nuevamente
    $conexion->autocommit(TRUE);

    exit();
}
