<?php
include 'conexion_be.php';

$idProducto = $_GET['idProducto'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idProducto'])) {
    $idProducto = $_POST['idProducto'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidadDisponible = $_POST['cantidadDisponible'];
    $imagen = $_FILES['imagen']['name'];
    $target = 'img/' . basename($imagen);

    $sql = "UPDATE producto SET nombre='$nombre', descripcion='$descripcion', precio='$precio', cantidadDisponible='$cantidadDisponible'" . ($imagen ? ", imagen='$imagen'" : "") . " WHERE idProducto='$idProducto'";
    if (mysqli_query($conexion, $sql) && ($imagen ? move_uploaded_file($_FILES['imagen']['tmp_name'], $target) : true)) {
        echo '<div class="alert alert-success">Producto actualizado con éxito.</div>';
    } else {
        echo '<div class="alert alert-danger">Error al actualizar el producto.</div>';
    }
}

if ($idProducto) {
    $producto = mysqli_query($conexion, "SELECT * FROM producto WHERE idProducto='$idProducto'");
    $producto = mysqli_fetch_assoc($producto);
}
?>

<div class="container">
    <h2>Actualizar Producto</h2>

    <?php if ($producto): ?>
        <!-- Formulario para actualizar producto -->
        <form action="update_product.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idProducto" value="<?php echo $producto['idProducto']; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $producto['descripcion']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" step="0.01" value="<?php echo $producto['precio']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="cantidadDisponible" class="form-label">Cantidad Disponible</label>
                <input type="number" class="form-control" id="cantidadDisponible" name="cantidadDisponible" value="<?php echo $producto['cantidadDisponible']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen (dejar en blanco para mantener la actual)</label>
                <input type="file" class="form-control" id="imagen" name="imagen">
                <?php if ($producto['imagen']): ?>
                    <img src="img/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>" width="100">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
        </form>
    <?php else: ?>
        <p>Producto no encontrado.</p>
    <?php endif; ?>
</div>
