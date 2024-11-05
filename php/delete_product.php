<?php
include 'conexion_be.php';

$idProducto = $_GET['idProducto'] ?? null;

if ($idProducto) {
    $sql = "DELETE FROM producto WHERE idProducto='$idProducto'";
    if (mysqli_query($conexion, $sql)) {
        header("Location: crud_producto.php");
        exit();
    } else {
        echo '<div class="alert alert-danger">Error al eliminar el producto.</div>';
    }
} else {
    echo '<div class="alert alert-danger">Producto no encontrado.</div>';
}
