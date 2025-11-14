<?php 
include 'conexionBD.php';



//en esta linea se confirma si se mando el formulario 
//en esta con strlen se obtiene la longitud de los campos del form y se verifica que se hayan completado
if (strlen($_POST['nombre']) > 3 && strlen($_POST['apellido']) > 3 && strlen($_POST['email']) > 3 && strlen($_POST['contrasenia']) > 3){
    //trim() me sirve para sacar los espacios en blancos asi llega el codigo limpio a la BD
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $correo = trim($_POST['email']);
    $contrasenia = trim($_POST['contrasenia']);

    $consulta;

        if ($contrasenia == 'admin2024@DBA') {
            $contrasenia = sha1($_POST['contrasenia']);
            $consulta = "INSERT INTO usuario( `nombre`, `apellido`, `correo`, `contrasena`, `tipo_de_usuario` ) VALUES ('$nombre','$apellido','$correo','$contrasenia','1')";
        } else{
            $contrasenia = sha1($_POST['contrasenia']);
            $consulta = "INSERT INTO usuario( `nombre`, `apellido`, `correo`, `contrasena`, `tipo_de_usuario` ) VALUES ('$nombre','$apellido','$correo','$contrasenia','0')";
        }
    
    // Sha1 funciona de la siguiente manera: encriptación de contraseña. Primero se hace un trim de la contraseña y luego se hace pasa el resultado a la función sha1 que lo encripta 
        
    // Ejecutamos la consulta en la base de datos
    $resultado = mysqli_query($conexion, $consulta);

    if($resultado){
        // Redirigimos al usuario a index.php después de 2 segundos
        header('location:../login.php');
        exit();
    } else {
        // Mostramos un mensaje de datos incorrectos
        echo "<h3>Datos incorrectos. Inténtelo nuevamente.</h3>";
    }
}
?>