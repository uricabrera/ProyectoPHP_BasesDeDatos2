<?php 
include 'conexionBD.php';

//en esta linea se confirma si se mando el formulario 
//en esta con strlen se obtiene la longitud de los campos del form y se verifica que se hayan completado
if ($_POST){ 
if (strlen($_POST['email']) > 0 && strlen($_POST['contraseña']) > 0){
    //trim() me sirve para sacar los espacios en blancos asi llega el codigo limpio a la BD
    $correo = trim($_POST['email']);
    $contrasenia = sha1(trim($_POST['contraseña']));

    $consulta = "SELECT * FROM usuario WHERE correo = '$correo' AND contrasena = '$contrasenia'";
        
    // Ejecutamos la consulta en la base de datos
    $resultado = mysqli_query($conexion, $consulta);


    if($resultado && mysqli_num_rows($resultado) > 0){

        $usuario = mysqli_fetch_assoc($resultado);
        session_start();
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['apellido'] = $usuario['apellido'];
        $_SESSION['correo'] = $usuario['correo'];
        $_SESSION['tipo_de_usuario']= $usuario['tipo_de_usuario'];
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        header('location:../index.php');
        exit();
    } else {
            // Mostramos un mensaje de datos incorrectos
            $mensaje_error = "<p class='mensaje_error'>Usuario no encontrado. Por favor, cree una cuenta <a href='./crear_cuenta.php'>aquí</a>.</p>";
    }
    } else {
        $mensaje_error = "<p class='mensaje_error'>Usuario no encontrado</p>";
    }
}
include "./login.php";
?>