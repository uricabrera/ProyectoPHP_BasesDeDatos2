<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido</title>
    <script src="https://kit.fontawesome.com/5f6de38f20.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./../CSS/detalles_pedido.css">
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['tipo_de_usuario'] == 2) {
        header('location: ./login.php');
    }
    include 'conexionBD.php';
    ?>
    <header class="header">
        <div class="logo">
            <a href="./../index.php"><img src="./../img/logo-marca-nuevo.jpg" alt="Logo de la marca"></a>
        </div>
        <nav>
            <ul>
                <li class="#Nosotros"><a href="./../nosotros.php">Nosotros</a></li>
                <li class="#Productos"><a href="./../productos.php">Prendas</a></li>
                <li class="carrito">
                    <a href="./../carrito.php" class="carrito">
                        Carrito <i class="fa-solid fa-cart-shopping"></i>
                        <span class="carrito-contador">
                            <?php echo isset($_SESSION["carrito"]) ? count($_SESSION["carrito"]) : 0; ?>
                        </span>
                    </a>
                </li>
                <?php if (isset($_SESSION['tipo_de_usuario']) && $_SESSION['tipo_de_usuario'] == 1) { ?>
                    <li class="#administrador"><a href="./../administrador/administrador.php">Administradores</a></li>
                <?php }; ?>
            </ul>
        </nav>
        <div class="ingreso">
            <?php if (isset($_SESSION['nombre'])) { ?>
                <a href="./../pagina_perfil.php" class="registrar"><button>Mi Cuenta <i class="fa-solid fa-user"></i></button></a>
            <?php } else { ?>
                <a href="./../login.php" class="registrar"><button>Ingresar <i class="fa-solid fa-user"></i></button></a>
            <?php }; ?>
        </div>
    </header>
    <main class="contenido_detalles">
        <?php
        $order_id = isset($_GET['id_orden']) ? intval($_GET['id_orden']) : 0;

        $consulta = "SELECT p.nombre, c.cantidad, p.precio FROM carrito c JOIN prenda p ON c.id_prenda = p.id_prenda WHERE c.id_orden = $order_id";
        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            echo "<h2>Detalles del Pedido #{$order_id}</h2>";
            echo '<table class="tabla_detalles">';
            echo '<thead><tr><th>Nombre de Prenda</th><th>Cantidad</th><th>Precio Unitario</th></tr></thead>';
            echo '<tbody>';

            $total = 0;
            while ($row = mysqli_fetch_assoc($resultado)) {
                $subtotal = $row['cantidad'] * $row['precio'];
                $total += $subtotal;
                echo '<tr>';
                echo "<td>{$row['nombre']}</td>";
                echo "<td>{$row['cantidad']}</td>";
                echo "<td>$" . number_format($row['precio'], 2) . "</td>";
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo "<h3>Total Pagado: $" . number_format($total, 2) . "</h3>";
            echo '<p class="mensaje_exito">¡Gracias por su compra! Su pedido ha sido procesado exitosamente.</p>';
            echo '<a href="./../productos.php" class="boton_volver">Volver a la tienda</a>';
        } else {
            echo "<p>No se encontraron detalles para el pedido #{$order_id}.</p>";
        }

        mysqli_close($conexion);
        ?>
    </main>
</body>

</html>