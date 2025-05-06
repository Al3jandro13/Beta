<?php
session_start(); // Iniciar sesión antes de cualquier verificación
include '../conexion.php';

if (!isset($_SESSION['codigo'])) {
    header("Location: ../login.php"); // Redirige al login si no hay sesión activa
    exit();
}

$conexion = connection(); // Llamar la función antes de hacer consultas

$sql = "SELECT prod_nombre, prod_stock FROM productos WHERE prod_stock < 6";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/boton.css">
    <link rel="stylesheet" href="../css/boton3.css">
    <link rel="stylesheet" href="../css/boton4.css">
</head>
<body>
<nav class="navbar-vertical">
    <ul class="navbar-links">
        <div class="navbar-header">
            <a href="../index.php"><h2>Elite Sport</h2></a>
        </div>
        <li class="nav-item has-submenu">
            <a href="#" class="nav-link"><i class="fas fa-users"></i> Usuarios</a>
            <div class="submenu">
                <a href="../usuario/usuarios.php"><i class="fas fa-list"></i> Ver Usuarios</a>
                <a href="../usuario/usuario.php"><i class="fas fa-plus"></i> Insertar Usuario</a>
            </div>
            <a href="#" class="nav-link"><i class="fas fa-box-open"></i> Productos</a>
            <div class="submenu">
                <a href="productos.php"><i class="fas fa-list"></i> Ver Productos</a>
                <a href="producto.php"><i class="fas fa-plus"></i> Insertar Productos</a>
            </div>
            <a href="#" class="nav-link"><i class="fas fa-truck"></i> Proveedor</a>
            <div class="submenu">
                <a href="../proveedor/proveedores.php"><i class="fas fa-list"></i> Ver Proveedores</a>
                <a href="../proveedor/proveedor.php"><i class="fas fa-plus"></i> Insertar Proveedores</a>
            </div>
            <a href="#" class="nav-link"><i class="fas fa-cash-register"></i> Ventas</a>
            <div class="submenu">
                <a href="../venta/ventas.php"><i class="fas fa-list"></i> Ver Ventas</a>
                <a href="../venta/venta.php"><i class="fas fa-plus"></i> Insertar Ventas</a>
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

<div class="content">
    <div class="form-container">
        <h2 class="form-title">Registrar Producto</h2>
        <form action="insert_producto.php" method="post" enctype="multipart/form-data">
            <div class="form-grid">
                <div class="form-column">
                    <div class="form-group-modern">
                        <label class="form-label">Código</label>
                        <input type="number" class="form-input" name="prod_codigo" required>
                    </div>
                    <div class="form-group-modern">
                        <label class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-input" name="prod_nombre" required>
                    </div>
                    <div class="form-group-modern">
                        <label class="form-label">Categoría</label>
                        <input type="text" class="form-input" name="prod_categoria" required>
                    </div>
                    <div class="form-group-modern">
                        <label class="form-label">Precio de Compra</label>
                        <input type="number" class="form-input" name="prod_preciocomp" required>
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-group-modern">
                        <label class="form-label">Precio de Venta</label>
                        <input type="number" class="form-input" name="prod_preciovent" required>
                    </div>
                    <div class="form-group-modern">
                        <label class="form-label">Talla</label>
                        <input type="text" class="form-input" name="prod_talla" required>
                    </div>
                    <div class="form-group-modern">
                        <label class="form-label">Color</label>
                        <input type="text" class="form-input" name="prod_color" required>
                    </div>
                    <div class="form-group-modern">
                        <label class="form-label">Stock</label>
                        <input type="number" class="form-input" name="prod_stock" required>
                    </div>
                </div>
            </div>

            <div class="form-group-modern">
                <label class="form-label">Código del Proveedor</label>
                <div class="select-wrapper">
                    <select class="form-input" name="prov_codigo" required>
                        <option value="">Código Proveedor</option>
                        <?php
                        require_once('../conexion.php');
                        $con = connection();
                        $sql_prov = "SELECT prov_codigo FROM proveedor";
                        $query_prov = mysqli_query($con, $sql_prov);
                        while ($row = mysqli_fetch_assoc($query_prov)) {
                            echo "<option value='" . htmlspecialchars($row['prov_codigo']) . "'>" . htmlspecialchars($row['prov_codigo']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group-modern">
                <label class="form-label">Imagen del Producto</label>
                <input type="file" class="form-input" name="prod_imagen" accept="image/*" required>
            </div>

            <div class="button-wrapper">
                <button type="submit" class="btn-submit">
                    <svg class="icon" viewBox="0 0 24 24" width="24" height="24">
                        <path d="M22,15.04C22,17.23 20.24,19 18.07,19H5.93C3.76,19 2,17.23 2,15.04C2,13.07 3.43,11.44 5.31,11.14C5.28,11 5.27,10.86 5.27,10.71C5.27,9.33 6.38,8.2 7.76,8.2C8.37,8.2 8.94,8.43 9.37,8.8C10.14,7.05 11.13,5.44 13.91,5.44C17.28,5.44 18.87,8.06 18.87,10.83C18.87,10.94 18.87,11.06 18.86,11.17C20.65,11.54 22,13.13 22,15.04Z"/>
                    </svg>
                    <span>Registrar</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script src="../js/menu.js"></script>
</body>
</html>