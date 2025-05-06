<?php
session_start();

include 'conexion.php';
$conexion = connection();

if (!isset($_SESSION['codigo'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT prod_nombre, prod_stock FROM productos WHERE prod_stock < 6";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido | Inventario</title>

    <!-- Tipografía cuadrada -->
    <link href="https://kit.fontawesome.com/a076d05399.js" rel="stylesheet">

    <!-- Estilos -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/boton2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <!-- Menú lateral -->
    <nav class="navbar-vertical">
        <ul class="navbar-links">
            <div class="navbar-header">
                <a href="index.php"><h2>Elite Sport</h2></a>
            </div>

            <li class="nav-item has-submenu">
                <a href="#" class="nav-link"><i class="fas fa-users"></i> Usuarios</a>
                <div class="submenu">
                    <a href="usuario/usuarios.php"><i class="fas fa-list"></i> Ver Usuarios</a>
                    <a href="usuario/usuario.php"><i class="fas fa-plus"></i> Insertar Usuario</a>
                </div>
            </li>

            <li class="nav-item has-submenu">
                <a href="#" class="nav-link"><i class="fas fa-box-open"></i> Productos</a>
                <div class="submenu">
                    <a href="producto/productos.php"><i class="fas fa-list"></i> Ver Productos</a>
                    <a href="producto/producto.php"><i class="fas fa-plus"></i> Insertar Productos</a>
                </div>
            </li>

            <li class="nav-item has-submenu">
                <a href="#" class="nav-link"><i class="fas fa-truck"></i> Proveedor</a>
                <div class="submenu">
                    <a href="proveedor/proveedores.php"><i class="fas fa-list"></i> Ver Proveedores</a>
                    <a href="proveedor/proveedor.php"><i class="fas fa-plus"></i> Insertar Proveedores</a>
                </div>
            </li>

            <li class="nav-item has-submenu">
                <a href="#" class="nav-link"><i class="fas fa-cash-register"></i> Ventas</a>
                <div class="submenu">
                    <a href="venta/ventas.php"><i class="fas fa-list"></i> Ver Ventas</a>
                    <a href="venta/venta.php"><i class="fas fa-plus"></i> Insertar Ventas</a>
                </div>
            </li>
        </ul>

        <div class="user-section">
            <a href="#"><i class="fas fa-user-cog"></i> Mi Usuario</a>
        </div>
        
        <div class="navbar-footer">
            <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </div>
    </nav>

    <!-- Contenido principal desplazado -->
    <div class="content" style="margin-left: 320px; padding: 2rem;">
        
        <!-- Encabezado centrado y más pequeño con fuente cuadrada -->
        <header class="hero" style="margin-bottom: 4rem; text-align: left; margin-left: 2rem;">
            <div class="hero-content">
                <h1 style="font-size: 2.35rem; color: #1a1a1a; margin-bottom: 1rem; font-family: 'Rajdhani', sans-serif;">
                    BIENVENIDO AL SISTEMA DE INVENTARIO ELITE SPORT
                </h1>
                <p style="font-size: 1.2rem; color: #555; font-family: 'Inter', sans-serif; text-align: center;">
                    Gestión eficiente y control total de tu stock.
                </p>
            </div>
        </header>

        <!-- Alertas de stock más abajo -->
        <div class="stock-alerts" style="margin-top: 5rem;">
            <h2 style="text-align: center; margin-bottom: 1.5rem;">Alertas de stock bajo</h2>
            <?php if ($resultado->num_rows > 0): ?>
                <div class="alerta-stock">
                    <h4><i class="fas fa-exclamation-triangle"></i> Productos con Bajo Stock</h4>
                    <ul>
                        <?php while ($fila = $resultado->fetch_assoc()): ?>
                            <li><strong><?php echo $fila['prod_nombre']; ?></strong> - <?php echo $fila['prod_stock']; ?> unidades</li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            <?php else: ?>
                <div class="alerta-stock success">
                    <h4><i class="fas fa-check-circle"></i> Todo en orden</h4>
                    <p>No hay productos con bajo stock.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</body>
</html>
<script src="js/menu.js"></script>
<?php
$conexion->close();
?>