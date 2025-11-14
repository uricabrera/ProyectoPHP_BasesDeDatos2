<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Marca de remeras de hombre y mujer ELITE">
    <meta property="og:title" content="Elite">
    <meta property="og:description" content="ELITE: Elegancia y Distinción en Cada Fibra">
    <meta property="og:image" content="./img/muestra4.jpg">
    <meta name="author" content="Fabricio Funes">
    <meta name="keywords" content="ropa, moda, tienda online, camisetas, remeras">
    <meta name="robots" content="index, follow">

    <title>Elite Remeras</title>
    <!------ Font Awesome ------->
    <script src="https://kit.fontawesome.com/5f6de38f20.js" crossorigin="anonymous"></script>
    <!-----CSS----->
    <link rel="stylesheet" href="./CSS/index.css">
</head>

<body>
    <!----- HEADER ----->
    <!--Include me sirve para hacer funciones con php y sql para poder usarlas en cualquier parte del codigo-->
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
            <?php if (isset($_SESSION['nombre'])) { ?>
                <a href="pagina_perfil.php" class="registrar"><button>Mi Cuenta <i class="fa-solid fa-user"></i></button></a>
            <?php } else { ?>
                <a href="login.php" class="registrar"><button>Ingresar <i class="fa-solid fa-user"></i></button></a>
            <?php }; ?>
        </div>
    </header>
    <!----- MAIN ----->
    <main>
        <section class="nosotros">
            <h2>Proyecto de tienda de remeras por Fabricio, Tomas y Uriel</h2>
            <p>"ELITE: Elegancia y Distinción en Cada Fibra

                Descubre ELITE, la marca que redefinirá tu estilo con sus remeras de algodón de primera calidad. Con un
                enfoque
                en la elegancia y la distinción, nuestras prendas están diseñadas para aquellos que buscan lo mejor en
                moda y
                confort.

                Fundada en la vibrante ciudad de Mendoza, ELITE es el resultado de la pasión y dedicación de los
                creadores Tomas
                Liñan, Fabricio Funes y Uriel Cabrera. Cada remera refleja nuestra dedicación a la excelencia, combinando materiales
                premium,
                diseños innovadores y una atención meticulosa a los detalles.

                Únete a la élite de la moda con ELITE y experimenta el lujo de vestir con estilo y confianza en cada
                ocasión.".
            </p>
        </section>
        <section class="remeras">
            <h2>Lista de Remeras de ELITE</h2>
            <div class="productos">
                <div class="columna">
                    <img src="./img/muestra1.jpg" alt="Remera 1">
                    <img src="./img/muestra2.jpg" alt="Remera 2">
                    <img src="./img/muestra1.jpg" alt="Remera 3">
                </div>
            </div>
            <div class="productos2">
                <div class="columna">
                    <img src="./img/muestra4.jpg" alt="Remera 4">
                    <img src="./img/muestra5.jpg" alt="Remera 5">
                    <img src="./img/muestra6.jpg" alt="Remera 6">
                </div>
            </div>
        </section>
    </main>
    <!----- FOOTER ----->
    <footer>
        <div class="container-footer">
            <p>&copy; 2024 Proyecto de Tienda de Ropa - HTML, PHP y SQL |
                <a href="https://www.uch.edu.ar/">Universidad Champagnat</a>
            </p>
        </div>
    </footer>
</body>

</html>
