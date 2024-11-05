<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="sidebar">
        <h2 class="text-center">CRUD Usuarios</h2>
        <a href="indexadmin.php?page=crud_usuario.php">Lista de Usuarios</a>
        <a href="indexadmin.php?page=crud_producto.php">CRUD Productos</a>
    </div>

    <div class="container mt-4">
        <!-- Aquí va el contenido del CRUD de usuarios -->
        <?php
        // Conectar a la base de datos
        include 'php/conexion_be.php';
        
        // Consultar usuarios
        $query = "SELECT * FROM usuario";
        $result = mysqli_query($conexion, $query);

        echo '<h2>Lista de Usuarios</h2>';
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Usuario</th><th>Teléfono</th><th>Acciones</th></tr></thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['idUsuario'] . '</td>';
            echo '<td>' . $row['nombre_completo'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['usuario'] . '</td>';
            echo '<td>' . $row['telefono'] . '</td>';
            echo '<td>
                    <a href="indexadmin.php?page=crud_usuario.php&update=' . $row['idUsuario'] . '" class="btn btn-warning btn-sm">Actualizar</a>
                    <a href="indexadmin.php?page=crud_usuario.php&delete=' . $row['idUsuario'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'¿Estás seguro de que quieres eliminar este usuario?\');">Eliminar</a>
                  </td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';

        mysqli_close($conexion);
        ?>
    </div>

</body>
</html>
