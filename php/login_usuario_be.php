<?php

session_start();



include 'conexion_be.php';

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);

// Consulta para validar el login
$validar_login = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario='$usuario' AND contraseña='$contrasena'");

// Verifica si el usuario existe
if (mysqli_num_rows($validar_login) > 0) {

    $_SESSION['usuario'] = $usuario;
    header("Location: ../catalogo.php");
    exit();
} else {
    echo '
    <script> 
    alert("Usuario no existe, por favor verifique los datos introducidos");
    window.location = "../login_usuario_be.php";
    </script>
    ';
    exit();
}

// Cierra la conexión
mysqli_close($conexion);
?>
