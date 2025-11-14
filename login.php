<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/login.css">
    <title>Ingresá tu Cuenta</title>
</head>

<body>
    <div class="header-inicio">
        <a href="./index.php"><img src="./img/logo-marca.jpg" alt="Logo de la marca"></a>
    </div>
    <div class="ingreso">
        <form action="Backend/verificar_login.php" method="post">
            <h1>Ingresá tu Cuenta</h1>
            <label for="email">Correo Electrónico</label><br>
            <input type="text" name="email" placeholder="Email" required><br>
            <label for="contraseña">Contraseña</label><br>
            <input type="password" name="contraseña" placeholder="Contraseña" required><br>
            <input type="submit" value="Iniciar Sesión" class="btn-iniciar-sesion">
        </form>

        <button class="btn-crear-cuenta"><a href="crear_cuenta.php">Crear Cuenta</a></button>

        <?php
        if (isset($mensaje_error)) {
            echo  $mensaje_error;
        }
        ?>
    </div>

</body>

</html>