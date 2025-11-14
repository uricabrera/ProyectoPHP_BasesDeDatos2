<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/crear_cuenta.css">
    <title>Crear cuenta</title>
</head>

<body>
    <div class="header-inicio">
        <a href="index.php"><img src="./img/logo-marca.jpg" alt="Logo de la marca"></a>
    </div>
    <div class="ingreso">
        <form action="Backend/crear_usuarioBD.php" method="post">
            <h1>Crear Cuenta</h1>
            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" required><br>
            <label for="apellido">Apellido</label><br>
            <input type="text" name="apellido" required><br>
            <label for="email">Correo Electrónico</label><br>
            <input type="text" name="email" required><br>
            <label for="contraseña">Contraseña</label><br>
            <input type="password" name="contrasenia" required><br>
            <!--<label for="tipo_usuario">Normal</label>
            <input type="radio" name="tipo_usuario" value="normal" id="tipo_usuario_normal">
            <label for="tipo_usuario">Admin</label>
            <input type="radio" name="tipo_usuario" value="admin" id="tipo_usuario_admin">
            -->
            <input type="submit" value="Crear Cuenta" class="btn-iniciar-sesion">
        </form>
    </div>

    <?php
    // include 'crear_usuarioBD.php';
    ?>
</body>

<!--<script>
    function insertAfter(newNode, existingNode) {
        existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling);
    }



    let checkbox = document.getElementById("tipo_usuario_admin");

    let checkbox_normal = document.getElementById("tipo_usuario_normal");

    checkbox.addEventListener("change", () => {
        if (checkbox.checked === true) {
            let input = document.createElement("input");
            input.type = "text";
            input.name = "clave_admin";
            input.id = "clave_admin";
            let label = document.createElement("label");
            label.textContent = "Insertar clave admin";
            label.id = "label_admin";
            insertAfter(label, checkbox);
            insertAfter(input, label);
        } 
    })


    checkbox_normal.addEventListener("change", () => {
        if (checkbox.checked === true) {
            let input_admin = document.getElementById("clave_admin");
            let label_admin = document.getElementById("label_admin");
            input_admin.remove();
            label_admin.remove();
        } else if (checkbox.checked === false) {
            let input_admin = document.getElementById("clave_admin");
            let label_admin = document.getElementById("label_admin");
            input_admin.remove();
            label_admin.remove();
        } else {
            let input_admin = document.getElementById("clave_admin");
            let label_admin = document.getElementById("label_admin");
            input_admin.remove();
            label_admin.remove();
        }
    })
</script>-->

</html>