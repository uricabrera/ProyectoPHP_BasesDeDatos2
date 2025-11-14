<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/5f6de38f20.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="./CSS/productos.css">
</head>

<?php session_start(); ?>

<body>
    <header class="header">
        <div class="logo">
            <a href="./index.php"><img src="./img/logo-marca-nuevo.jpg" alt="Logo de la marca"></a>
        </div>
        <nav>
            <ul>
                <li class="#Nosotros"><a href="nosotros.php">Nosotros</a></li>
                <li class="#Productos"><a href="productos.php">Prendas</a></li>
                <li class="carrito"><a href="carrito.php" class="carrito">Carrito <i class="fa-solid fa-cart-shopping"></i> <span class="carrito-contador"> <?php echo isset($_SESSION["carrito"]) ? count($_SESSION["carrito"]) :  0; ?> </span> </a></li>
                <?php if (isset($_SESSION['tipo_de_usuario']) && $_SESSION['tipo_de_usuario'] == 1) { ?>
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

    <main class="productos__main">
        <h1>Productos ELITE</h1>
        <div class="seccion_container_productos">
        </div>
    </main>
</body>

<script>
    let contador = <?php echo isset($_SESSION["carrito"]) ? count($_SESSION["carrito"]) : 0; ?>;
    $(document).ready(function() {
        $.ajax({
            url: "./restful_api/productosajax.php",
            type: "get",
            dataType: "json",
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            },
            success: function(data) {
                let container_producto = document.getElementsByClassName("seccion_container_productos")[0];
                let wrapper = document.createElement("div");
                wrapper.classList.add("wrapper_container_productos");

                data.forEach(prenda => {
                    let opciones = Array.from({
                        length: prenda['cantidad']
                    }, (_, i) => `<option value="${i + 1}">${i + 1}</option>`).join('');
                    let prendaHtml = `
                        <div class="seccion_container_productos_tarjeta">
                            <img src="./img/productos_img/${prenda['imagen']}" alt="Imagen del producto">
                            <h4>${prenda['nombre']}</h4>
                            <p>${prenda['descripcion']}</p>
                            <p>talle: ${prenda['talle']}</p>
                            <p>color: ${prenda['color']}</p>
                            <p>precio: ${prenda['precio']}</p>

                            ${prenda['isAdmin'] !== 2 ? `
                            <div class="form-group">
                                <label for="cantidad-${prenda['id_prenda']}">Cantidad:</label>
                                <select id="cantidad-${prenda['id_prenda']}" name="cantidad" class="form-control custom-select">
                                    ${opciones}
                                </select>
                            </div>
                            ${prenda['cantidad'] > 0 ? `<button type="submit" name="btnAgregar" data-id="${prenda['id_prenda']}" class="btn btn-primary">Agregar al carrito</button>` : "<p>No hay stock</p>" } ` : ""}
                            
                            ${prenda['isAdmin'] === 1 ? `<a href='./administrador/editar_producto.php?id_prenda=${prenda["id_prenda"]}' class="btn btn-edit">Editar Producto</a>` : ""}
                            ${prenda['isAdmin'] === 1 ? `<a href='./administrador/eliminar_producto.php?prenda_id=${prenda["id_prenda"]}' class="btn btn-delete">Eliminar Producto</a>` : ""}
                        </div>
                        </div>
                    `;
                    wrapper.innerHTML += prendaHtml;
                });

                container_producto.appendChild(wrapper);

                document.querySelectorAll('button[name="btnAgregar"]').forEach(boton => {
                    boton.addEventListener('click', (e) => {
                        let idPrenda = e.target.getAttribute('data-id');
                        let cantidadPrenda = document.getElementById(`cantidad-${idPrenda}`).value;
                        $.ajax({
                            url: './restful_api/agregarcarrito.php',
                            type: 'POST',
                            data: {
                                id: idPrenda,
                                cantidad: cantidadPrenda
                            },
                            success: function(response) {
                                if (cantidadPrenda > 0) {
                                    contador++;
                                    document.querySelector('.carrito-contador').textContent = contador;
                                }
                            }
                        });
                    });
                });
            }
        });
    });
</script>

</html>