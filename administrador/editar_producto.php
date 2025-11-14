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
    include "./../Backend/conexionBD.php";

    ?>
    <?php
    if ($_SESSION['tipo_de_usuario'] != 1) {
        header('location:../login.php');
    }

    $consulta = "SELECT * FROM prenda WHERE id_prenda = {$_GET['id_prenda']}";

    $resultado = mysqli_query($conexion, $consulta);

    $resultado_obtenido = mysqli_fetch_assoc($resultado);
    ?>
    <header class="header">
        <div class="logo">
            <a href="/index.php"><img src="./../img/logo-marca-nuevo.jpg" alt="Logo de la marca"></a>
        </div>
        <nav>
            <ul>
                <li class="#Nosotros"><a href="./../nosotros.php">Nosotros</a></li>
                <li class="#Productos"><a href="./../productos.php">Prendas</a></li>
                <li class="carrito"><a href="./../carrito.php" class="carrito">Carrito <i class="fa-solid fa-cart-shopping"></i></a></li>
                <?php
                if (isset($_SESSION['tipo_de_usuario']) && $_SESSION['tipo_de_usuario'] == 1) { ?>
                    <li class="#administrador"><a href="./../administrador/administrador.php">Administradores</a></li>
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
    <main>
        <div class="editar__prenda">
            <form action="./editar_accion.php?id_prenda=<?php echo $_GET["id_prenda"] ?>" method="post" enctype="multipart/form-data">
                <label for="nombre">Prenda</label>
                <input type="text" name="nombre" required value="<?php echo $resultado_obtenido['nombre'] ?>">
                <label for="descripcion">Descripcion</label>
                <textarea name="descripcion">
                    <?php echo $resultado_obtenido['descripcion'] ?>
                </textarea>
                <label for="talla">Talla</label>
                <select name="talla" required value=<?php echo $resultado_obtenido['talle'] ?>>
                    <?php
                    echo "<option value={$resultado_obtenido['talle']}>{$resultado_obtenido['talle']}</option>"
                    ?>
                    <option value="XS">XS</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>
                <label for="color">Color</label>
                <input type="text" name="color" required value="<?php echo $resultado_obtenido['color'] ?>">
                <label for="precio">Precio</label>
                <input type="text" name="precio" id="nuevo_producto_precio" required value="<?php echo $resultado_obtenido['precio'] ?>">
                <label for="marca">Marca</label>
                <select name="marca" id="productos_marca">
                    <?php
                    include "./../Backend/conexionBD.php";

                    $consulta = "SELECT nombre, id_marca FROM marca";

                    $resultado_marca = mysqli_query($conexion, $consulta);

                    while ($i = $resultado_marca->fetch_assoc()) {
                        echo "<option value='{$i["id_marca"]}'";
                        if ($i["id_marca"] == $resultado_obtenido['id_marca']) {
                            echo "selected required";
                        }
                        echo ">{$i["nombre"]} </option>";
                    }



                    ?>

                </select>
                <label for="proveedor">Proveedor</label>
                <select name="proveedor" id="productos_proveedor">
                    <?php


                    $consulta = "SELECT nombre, id_proveedor FROM proveedor";


                    $resultado_proveedor = mysqli_query($conexion, $consulta);

                    while ($i = $resultado_proveedor->fetch_assoc()) {
                        echo "<option value='{$i["id_proveedor"]}'";
                        if ($i["id_proveedor"] == $resultado_obtenido['id_proveedor']) {
                            echo "selected required";
                        }
                        echo ">{$i["nombre"]} </option>";
                    }
                    ?>
                </select>
                <label for="cantidad">Cantidad de prenda</label>
                <input type="text" name="cantidad" id="nuevo_producto_precio" value="<?php echo $resultado_obtenido['cantidad'] ?>" required>
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" accept="image/*" class="nuevo_producto_imagen" placeholder="Ingresar el archivo de imagen" required>

                <div class="preview">
                    <p>No se detectan archivos en el preview</p>
                </div>
                <input type="submit" class="subir__btn" value="Editar producto" name="subir">
            </form>
        </div>
    </main>

    <!-----JavaScrip----->
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




        setInputFilter(document.getElementById("nuevo_producto_precio"), function(value) {
            return /^\d*\.?\d*$/.test(value); // Permite solo valores digitos (numericos)
        }, "Solo valores numericos se pueden añadir");



        const input = document.querySelector(".nuevo_producto_imagen");
        const preview = document.querySelector(".preview");

        input.addEventListener("change", updateImageDisplay);
    </script>






</body>