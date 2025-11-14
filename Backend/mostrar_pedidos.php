<?php
// detalles_pedido.php

if ($_SESSION['tipo_de_usuario'] == 2) {
    header('location: ./login.php');
}
include 'conexionBD.php';

// Consulta para obtener los pedidos del usuario
$consulta = "SELECT id_orden, fecha FROM carrito WHERE id_usuario = {$_SESSION['id_usuario']} GROUP BY id_orden ORDER BY fecha DESC";
$resultado = mysqli_query($conexion, $consulta);

// Verificar si hay resultados
if (mysqli_num_rows($resultado) == 0) {
    echo '<p>Realice una compra para mostrar su pedido.</p>';
} else {
    echo '<h2>Mis pedidos</h2>';
    echo '<table class="tabla_pedidos">';
    echo '<thead><tr><th>Orden</th><th>Fecha del Pedidos</th><th>Detalles</th></tr></thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($resultado)) {
        $id_orden = $row['id_orden'];
        $fecha = $row['fecha'];
        echo '<tr>';
        echo "<td>Pedido #{$id_orden}</td>";
        echo "<td>{$fecha}</td>";
        echo "<td><a href='./Backend/detalles_pedido.php?id_orden={$id_orden}'>Ver detalles</a></td>";
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
}

// Cerrar la conexión
mysqli_close($conexion);
?>