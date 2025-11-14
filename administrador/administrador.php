<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!------ Font Awesome ------->
    <script src="https://kit.fontawesome.com/5f6de38f20.js" crossorigin="anonymous"></script>
    <!-----CSS----->
    <link rel="stylesheet" href="./../CSS/administrador.css">
    <title>Administradores</title>
</head>

<body>
    <?php session_start();
    ?>
    <header class="header">
        <div class="logo">
            <a href="./../index.php"><img src="./../img/logo-marca-nuevo.jpg" alt="Logo de la marca"></a>
        </div>
        <nav>
            <ul>
                <li class="#Nosotros"><a href="./../nosotros.php">Nosotros</a></li>
                <li class="#Productos"><a href="./../productos.php">Prendas</a></li>
                <li class="carrito"><a href="./../carrito.php" class="carrito">Carrito <i class="fa-solid fa-cart-shopping"></i></a>
                    <span class="carrito-contador">
                        <?php echo isset($_SESSION["carrito"]) ? count($_SESSION["carrito"]) : 0; ?>
                    </span>
                </li>
                <?php
                if ($_SESSION['tipo_de_usuario'] != 1) {
                    header('location:../login.php');
                }


                if (isset($_SESSION['tipo_de_usuario']) && $_SESSION['tipo_de_usuario'] == 1) { ?>
                    <li class="#administrador"><a href="./../administrador/administrador.php">Administradores</a></li>
                <?php }; ?>
            </ul>
        </nav>
        <div class="ingreso">
            <?php
            if (isset($_SESSION['nombre'])) { ?>
                <a href="./../pagina_perfil.php" class="registrar"><button>Mi Cuenta <i class="fa-solid fa-user"></i></button></a>
            <?php } else { ?>
                <a href="./../login.php" class="registrar"><button>Ingresar <i class="fa-solid fa-user"></i></button></a>
            <?php }; ?>
        </div>
    </header>
    <h1>Hola Administrador: <?php echo "{$_SESSION['nombre']} {$_SESSION['apellido']}"; ?></h1>
    <hr>
    <h3 class="administrador_titulo">Administrar productos</h3>
    <main class="productos">
        <!--Ingresar PROVEEDOR-->
        <div class="proveedor">
            <h4><b>Añadir Proveedor</b></h4>
            <form action="./nuevo_proveedorBD.php" method="post">
                <label for="nombre">Nombre Proveedor</label>
                <input type="text" name="nombre" required>
                <label for="telefono">Telefono Proveedor</label>
                <input type="number" name="telefono" id="nuevo_producto_precio" required>
                <label for="gmail">Correo Electronico</label>
                <input type="text" name="gmail" required>
                <input type="submit" value="Nuevo proveedor" class="btn_nuevo_proveedor">
            </form>
        </div>


        <!--Ingresar MARCA-->
        <div class="marca">
            <h4><b>Añadir Marca</b></h4>
            <form action="./nueva_marcaBD.php" method="post">
                <label for="nombre">Nombre Marca</label>
                <input type="text" name="nombre" required>
                <label for="des_de_marca">Descripcion de Marca</label>
                <textarea name="descripcion" id=""></textarea>
                <input type="submit" value="Nueva Marca" class="btn_nuevo_proveedor">
            </form>
        </div>

        <!--Ingresar PRENDA-->
        <div class="producto">
            <h4><b>Añadir Producto</b></h4>
            <form action="./nuevo_productoBD.php" method="post" enctype="multipart/form-data">
                <label for="nombre">Prenda</label>
                <input type="text" name="nombre" required>
                <label for="descripcion">Descripcion</label>
                <textarea name="descripcion"></textarea>
                <label for="talla">Talla</label>
                <select name="talla" required>
                    <option value="XS">XS</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>
                <label for="color">Color</label>
                <input type="text" name="color" required>
                <label for="precio">Precio</label>
                <input type="number" name="precio" id="nuevo_producto_precio" required>
                <label for="marca">Marca</label>
                <select name="marca" id="productos_marca">
                    <?php
                    include "./../Backend/conexionBD.php";

                    $consulta = "SELECT * FROM marcanombreidvista";

                    $resultado_marca = mysqli_query($conexion, $consulta);

                    while ($i = $resultado_marca->fetch_assoc()) {
                        echo "<option value='{$i["id_marca"]}'> {$i["nombre"]} </option>";
                    }



                    ?>

                </select>
                <label for="proveedor">Proveedor</label>
                <select name="proveedor" id="productos_proveedor">
                    <?php


                    $consulta = "CALL ObtenerProveedores();";


                    $resultado_proveedor = mysqli_query($conexion, $consulta);

                    while ($i = $resultado_proveedor->fetch_assoc()) {
                        echo "<option value='{$i["id_proveedor"]}'> {$i["nombre"]} </option>";
                    }

                    ?>

                </select>
                <label for="cantidad">Cantidad de prenda</label>
                <input type="text" name="cantidad" id="nuevo_producto_precio" required>
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" accept="image/*" class="nuevo_producto_imagen" placeholder="Ingresar el archivo de imagen" required>

                <div class="preview">
                    <p>No se detectan archivos en el preview</p>
                </div>
                <input type="submit" value="Subir nuevo producto" name="subir">
            </form>
        </div>
        <h4><b>Mostrar Usuarios y Pedidos</b></h4>
        <!--Mostrar usuarios con sus pedidos-->
        <div class="usuarios_pedidos">
            <?php
            // Manejar resultados pendientes
            while ($conexion->more_results() && $conexion->next_result()) {
                // Descartar resultados
            }

            $consulta = "SELECT usuario.nombre, carrito.id_orden, carrito.id_prenda,carrito.cantidad,prenda.nombre as 'nombrePrenda' FROM usuario INNER JOIN carrito ON usuario.id_usuario = carrito.id_usuario INNER JOIN prenda ON prenda.id_prenda = carrito.id_prenda";
            $resultado = mysqli_query($conexion, $consulta);

            if (!$resultado) {
                echo "Error en la consulta: " . mysqli_error($conexion);
            } else {
                if ($resultado->num_rows > 0) {
                    echo "<table border='1'>";
                    echo "<tr><th>Nombre de Usuarios</th><th>Numero De Orden</th><th>ID de prenda</th><th>Nombre prenda</th><th>Unidad por prenda</th></tr>";
                    while ($row = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . ($row['nombre']) . "</td>";
                        echo "<td>" . ($row['id_orden']) . "</td>";
                        echo "<td>" . ($row['id_prenda']) . "</td>";
                        echo "<td>" . ($row['nombrePrenda']) . "</td>";
                        echo "<td>" . ($row['cantidad']) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No se encontraron usuarios con pedidos.";
                }
            }
            ?>
        </div>
    </main>

</body>


<script>
    function setInputFilter(textbox, inputFilter, errMsg) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"].forEach(function(
            event) {
            textbox.addEventListener(event, function(e) {
                if (inputFilter(this.value)) {
                    // Accepted value.
                    if (["keydown", "mousedown", "focusout"].indexOf(e.type) >= 0) {
                        this.classList.remove("input-error");
                        this.setCustomValidity("");
                    }

                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    // Rejected value: restore the previous one.
                    this.classList.add("input-error");
                    this.setCustomValidity(errMsg);
                    this.reportValidity();
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    // Rejected value: nothing to restore.
                    this.value = "";
                }
            });
        });
    }


    function updateImageDisplay() {
        while (preview.firstChild) {
            preview.removeChild(preview.firstChild);
        }

        const curFiles = input.files;
        if (curFiles.length === 0) {
            const para = document.createElement("p");
            para.textContent = "No hay imagenes que hayan sido agregadas";
            preview.appendChild(para);
        } else {
            const list = document.createElement("ol");
            preview.appendChild(list);

            for (const file of curFiles) {
                const listItem = document.createElement("li");
                const para = document.createElement("p");
                if (file) {
                    para.textContent = `Nombre archivo ${file.name}, Tamaño archivo ${file.size}.`;
                    const image = document.createElement("img");
                    image.src = URL.createObjectURL(file);
                    image.alt = image.title = file.name;

                    listItem.appendChild(image);
                    listItem.appendChild(para);
                } else {
                    para.textContent =
                        `Nombre archivo ${file.name}: No es un tipo válido de archivo. Actualiza tu seleccion de archivo.`;
                    listItem.appendChild(para);
                }

                list.appendChild(listItem);
            }
        }
    }




    const input = document.querySelector(".nuevo_producto_imagen");
    const preview = document.querySelector(".preview");

    input.addEventListener("change", updateImageDisplay);
</script>

</html>