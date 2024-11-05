<?php
include 'php/conexion_be.php';

// Insertar nuevo producto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $cantidadDisponible = $_POST['cantidadDisponible'];
        $imagen = $_FILES['imagen']['name'];
        $target = 'img/' . basename($imagen);

        $sql = "INSERT INTO producto (nombre, descripcion, precio, cantidadDisponible, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$cantidadDisponible', '$imagen')";
        if (mysqli_query($conexion, $sql) && move_uploaded_file($_FILES['imagen']['tmp_name'], $target)) {
            echo '<div class="alert alert-success">Producto añadido con éxito.</div>';
        } else {
            echo '<div class="alert alert-danger">Error al añadir el producto.</div>';
        }
    }
}

// Eliminar producto
if (isset($_GET['delete'])) {
    $idProducto = $_GET['delete'];
    $sql = "DELETE FROM producto WHERE idProducto='$idProducto'";
    if (mysqli_query($conexion, $sql)) {
        echo '<div class="alert alert-success">Producto eliminado con éxito.</div>';
    } else {
        echo '<div class="alert alert-danger">Error al eliminar el producto.</div>';
    }
}

$productos = mysqli_query($conexion, "SELECT * FROM producto");
?>

<div class="container">
    <h2>CRUD de Productos</h2>

    <!-- Formulario para añadir producto -->
    <form action="crud_producto.php" method="POST" enctype="multipart/form-data">
        <h3>Añadir Producto</h3>
        <input type="hidden" name="action" value="add">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="cantidadDisponible" class="form-label">Cantidad Disponible</label>
            <input type="number" class="form-control" id="cantidadDisponible" name="cantidadDisponible" required>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen" required>
        </div>
        <button type="submit" class="btn btn-primary">Añadir Producto</button>
    </form>

    <hr>

    <!-- Listado de productos -->
    <h3>Listado de Productos</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad Disponible</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($producto = mysqli_fetch_assoc($productos)) : ?>
                <tr>
                    <td><?php echo $producto['idProducto']; ?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo $producto['descripcion']; ?></td>
                    <td><?php echo $producto['precio']; ?></td>
                    <td><?php echo $producto['cantidadDisponible']; ?></td>
                    <td><img src="img/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>" width="100"></td>
                    <td>
                        <a href="update_product.php?idProducto=<?php echo $producto['idProducto']; ?>" class="btn btn-warning btn-sm">Actualizar</a>
                        <a href="crud_producto.php?delete=<?php echo $producto['idProducto']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
