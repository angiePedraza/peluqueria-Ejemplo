<?php

include 'conexion_be.php';

// Obtén las variables de entrada
$nombre_completo = $_POST['nombre_completo'];
$email = $_POST['email'];
$usuario = $_POST['usuario'];
$telefono = $_POST['telefono'];
$contrasena = $_POST['contrasena'];

//encriptamiento contraseña
$contrasena = hash('sha512', $contrasena);

// Consulta SQL para insertar datos
$query = "INSERT INTO usuario(nombre_completo, email, usuario, contraseña, telefono) 
VALUES ('$nombre_completo', '$email', '$usuario', '$contrasena', '$telefono')";

// Verifica que el correo no se repita en la base de datos
$verfi_correo = mysqli_query($conexion, "SELECT * FROM usuario WHERE email='$email'");

if (mysqli_num_rows($verfi_correo) > 0) {
    echo '
    <script>
    alert("Este correo ya está registrado, intenta con otro diferente");
    window.location = "../login.php";
    </script>
    ';
    exit();
}

// Verifica que el usuario no se repita en la base de datos
$verfi_usuario = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario='$usuario'");

if (mysqli_num_rows($verfi_usuario) > 0) {
    echo '
    <script>
    alert("Este usuario ya está registrado, intenta con otro diferente");
    window.location = "../login.php";
    </script>
    ';
    exit();
}
// Ejecuta la consulta de inserción
$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '
    <script>
    alert("Usuario registrado exitosamente");
    window.location = "../login.php";
    </script>
    ';
} else {
    echo '
    <script>
    alert("Intentelo de nuevo, el usuario no se registró exitosamente");
    window.location = "../login.php";
    </script>
    ';
}

// Cierra la conexión
mysqli_close($conexion);
?>
