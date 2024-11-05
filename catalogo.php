<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '
    <script>
    alert("Por favor inicie sesión");
    window.location = "login.php";
    </script>
    ';
    
    session_destroy();
    die();
}
$nombre_usuario = $_SESSION['usuario'];

// Conectar a la base de datos
include 'php/conexion_be.php';

// Consultar productos
$query = "SELECT * FROM producto";
$result = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catálogo</title>
    <link rel="shortcut icon" href="img/icono2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/estilos1.css">
    <script src="js/main3.js" async></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <nav>
            <a href="php/cerrar_sesion.php">Cerrar Sesión</a>
        </nav>

        <section class="textos-header">
            <h1>Nuestro Catálogo en Productos de belleza</h1>
            <h2>Encuentra lo mejor para ti</h2>
            <p>Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?>!</p>
        </section><br>
        <div class="wave" style="height: 150px; overflow: hidden;">
            <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
                <path d="M0.00,49.98 C150.00,150.00 349.20,-50.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"
                    style="stroke: none; fill: #ffffff;"></path>
            </svg>
        </div>
    </header>

    <section class="contenedor">
        <!-- Contenedor de elementos -->
        <div class="contenedor-items">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="item">
                    <span class="titulo-item"><?php echo htmlspecialchars($row['nombre']); ?></span>
                    <img src="<?php echo htmlspecialchars($row['imagen']); ?>" alt="" class="img-item">
                    <span class="precio-item">$<?php echo number_format($row['precio'], 0, '', '.'); ?></span>
                    <form method="post" action="agregar_carrito.php">
                        <input type="hidden" name="idProducto" value="<?php echo $row['idProducto']; ?>">
                        <button type="submit" class="boton-item">Agregar al Carrito</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </section>

    <?php
    // Cerrar la conexión
    mysqli_close($conexion);
    ?>
</body>
</html>
