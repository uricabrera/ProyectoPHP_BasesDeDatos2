<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/pagina_perfil.css">
    <title>Perfil_usuario</title>
</head>

<body>
    <header class="header">
        <div class="logo">
            <a href="./index.php"><img src="./img/logo-marca-nuevo.jpg" alt="Logo de la marca"></a>
        </div>
        <nav>
            <ul>
                <li class="#Nosotros"><a href="nosotros.php">Nosotros</a></li>
                <li class="#Productos"><a href="productos.php">Prendas</a></li>
                <li class="carrito">
                    <a href="carrito.php" class="carrito">
                        Carrito <i class="fa-solid fa-cart-shopping"></i>
                        <span class="carrito-contador">
                            <?php echo isset($_SESSION["carrito"]) ? count($_SESSION["carrito"]) : 0; ?>
                        </span>
                    </a>
                </li>
                <?php
                if (isset($_SESSION['tipo_de_usuario']) && $_SESSION['tipo_de_usuario'] == 1) { ?>
                    <li class="#administrador"><a href="./administrador/administrador.php">Administradores</a></li>
                <?php }; ?>
            </ul>
        </nav>
        <div class="ingreso">
            <?php if (isset($_SESSION['nombre'])) { ?>
                <a href="pagina_perfil.php" class="registrar"><button>Mi Cuenta <i class="fa-solid fa-user"></i></button></a>
            <?php } else { ?>
                <a href="login.php" class="registrar"><button>Ingresar <i class="fa-solid fa-user"></i></button></a>
            <?php }; ?>
        </div>
    </header>
    <main class="main">
        <div class="contenedor_cuenta">
            <div class="mi_cuenta">
                <h1>Mi cuenta</h1>
                <h3>DATOS PERSONALES</h3>
                <hr>
                <?php
                echo "<p>{$_SESSION['nombre']} {$_SESSION['apellido']} </p>";
                echo "<p>{$_SESSION['correo']}</p>";
                ?>
                <button><a href="./Backend/cerrar_sesion.php" class="cerrar_sesion">CERRAR SESIÓN</a></button>
            </div>
        </div>
        <div class="contenedor_pedidos">
            <?php include './Backend/mostrar_pedidos.php'; ?>
        </div>
    </main>
</body>

</html>