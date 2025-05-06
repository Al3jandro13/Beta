
<?php
session_start();
include '../conexion.php';

if (!isset($_SESSION['codigo'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/boton.css">
</head>
<nav class="navbar-vertical">
<ul class="navbar-links">
    <div class="navbar-header">
    <a href="../index.php">
            <h2>Elite Sport</h2>
        </a>
    </div>
     <li class="nav-item has-submenu">
    <a href="#" class="nav-link">
        <i class="fas fa-users"></i> Usuarios
    </a>
    <div class="submenu">
        <a href="usuarios.php">
            <i class="fas fa-list"></i> Ver Usuarios
        </a>
        <a href="usuario.php">
            <i class="fas fa-plus"></i> Insertar Usuario
        </a>
    </div>

<a href="#" class="nav-link">
   <i class="fas fa-box-open"></i> Productos
</a>
<div class="submenu">
   <a href="../producto/productos.php">
       <i class="fas fa-list"></i> Ver Productos
   </a>
   <a href="../producto/producto.php">
       <i class="fas fa-plus"></i> Insertar Productos
   </a>
</div>
<a href="#" class="nav-link">
   <i class="fas fa-truck"></i> Proveedor
</a>
<div class="submenu">
   <a href="../proveedor/proveedores.php">
       <i class="fas fa-list"></i> Ver Proveedores
   </a>
   <a href="../proveedor/proveedor.php">
       <i class="fas fa-plus"></i> Insertar Proveedores
   </a>
</div>
<a href="#" class="nav-link">
   <i class="fas fa-cash-register"></i> Ventas
</a>
<div class="submenu">
   <a href="../venta/ventas.php">
       <i class="fas fa-list"></i> Ver Ventas
   </a>
   <a href="../venta/venta.php">
       <i class="fas fa-plus"></i> Insertar Ventas
   </a>
</div>
</li>
    </ul>
    
    <div class="user-section">
        <a href="#">
            <i class="fas fa-user-cog"></i>
            Mi Usuario
        </a>
    </div>
    
    <div class="navbar-footer">
        <a href="../logout.php">
            <i class="fas fa-sign-out-alt"></i>
            Cerrar Sesión
        </a>
    </div>
</nav>
    <div class="content">
    <div class="form-container">
        <h2 class="form-title">Registrar Nuevo Usuario</h2>
        
        <form action="insert_user.php" method="post">
            <div class="form-grid">
                <!-- Columna Izquierda -->
                <div class="form-column">
                    <div class="form-group-modern">
                        <label class="form-label">Código de Usuario</label>
                        <input type="text" class="form-input" name="codigo" required>
                    </div>
                    
                    <div class="form-group-modern">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-input" name="user_nombre" required>
                    </div>
                    
                    <div class="form-group-modern">
                        <label class="form-label">Apellido</label>
                        <input type="text" class="form-input" name="user_apellido" required>
                    </div>
                    
                    <div class="form-group-modern">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-input" name="user_contra" required>
                    </div>
                </div>

                <!-- Columna Derecha -->
                <div class="form-column">
                    <div class="form-group-modern">
                        <label class="form-label">Cédula</label>
                        <input type="text" class="form-input" name="user_cc" required>
                    </div>
                    
                    <div class="form-group-modern">
                        <label class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-input" name="user_fechanac" required>
                    </div>
                    
                    <div class="form-group-modern">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-input" name="user_tel" required>
                    </div>
                    
                    <div class="form-group-modern">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-input" name="user_correo" required>
                    </div>
                </div>
            </div>

            <div class="form-group-modern">
                <label class="form-label">Rol del Usuario</label>
                <div class="select-wrapper">
                    <select class="form-input" name="user_rol" required>
                        <option value="">Seleccione un rol...</option>
                        <option value="CEO">CEO</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Usuario">Usuario Estándar</option>
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


</div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/menu.js"></script>
</body>
</html>