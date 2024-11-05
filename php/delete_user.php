<?php
include 'conexion_be.php';

if (isset($_GET['idUsuario'])) {
    $idUsuario = $_GET['idUsuario'];
    $delete_query = "DELETE FROM usuario WHERE idUsuario = '$idUsuario'";
    mysqli_query($conexion, $delete_query);
    header('Location: ../indexadmin.php');
    exit();
}
?>
