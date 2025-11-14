<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/5f6de38f20.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS/nosotros.css">
    <title>Nosotros</title>
    <!------ Font Awesome ------->
    <script src="https://kit.fontawesome.com/5f6de38f20.js" crossorigin="anonymous"></script>
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
                <?php session_start(); ?>
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
            <?php
            if (isset($_SESSION['nombre'])) { ?>
                <a href="pagina_perfil.php" class="registrar"><button>Mi Cuenta <i class="fa-solid fa-user"></i></button></a>
            <?php } else { ?>
                <a href="login.php" class="registrar"><button>Ingresar <i class="fa-solid fa-user"></i></button></a>
            <?php }; ?>
        </div>
    </header>

    <main class="nosotros">
        <h1>Sobre Nosotros</h1>
        <p>Bienvenidos a Elite, una tienda online de ropa ficticia creada como proyecto para la materia de Bases de Datos 2 en la Licenciatura en Sistemas en la Universidad Champagnat de Mendoza. Elite ha sido diseñado para demostrar nuestras habilidades en el desarrollo web, combinando HTML, CSS, JavaScript, PHP y phpMyAdmin para ofrecer una experiencia de compra online completa y funcional.</p>
        <p>La tienda ha sido desarrollada utilizando las siguientes tecnologías:</p>
        <ul class="tecnologias">
            <li><img src="./img/logos_nosotros/html5_img.png" alt="HTML Logo">HTML</li>
            <li><img src="./img/logos_nosotros/CSS3_logo_and_wordmark.svg.png" alt="CSS Logo"> CSS</li>
            <li><img src="./img/logos_nosotros/Unofficial_JavaScript_logo_2.svg.png" alt="JavaScript Logo"> JavaScript</li>
            <li><img src="./img/logos_nosotros/PHP-logo.svg.png" alt="PHP Logo"> PHP</li>
            <li><img src="./img/logos_nosotros/phpmyadmin-icon-6.png" alt="phpMyAdmin Logo"> phpMyAdmin</li>
        </ul>
        <p>Fecha del proyecto: 2024</p>
        <p>Desarrolladores:</p>
        <ul class="desarrolladores">
            <li>Fabricio Funes - <a href="https://www.linkedin.com/in/fabricio-funes-dev/" target="_blank">LinkedIn</a></li>
            <li>Uriel Cabrera - <a href="https://github.com/uricabrera" target="_blank">Github</a></li>
            <li>Tomas Liñán - <a href="https://www.linkedin.com/in/tomaslinan" target="_blank">LinkedIn</a></li>
        </ul>
    </main>
</body>

</html>