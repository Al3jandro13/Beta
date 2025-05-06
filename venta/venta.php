<?php 
session_start();
include '../conexion.php';

// Verificar si el usuario ha iniciado sesión
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
    <title>Venta</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/boton.css">
    <link rel="stylesheet" href="../css/boton3.css">
    <link rel="stylesheet" href="../css/boton4.css">

   <!-- CSS para las notificaciones -->
<style>
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        max-width: 400px;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        animation: slideIn 0.3s ease-out forwards;
    }

    .notification.error {
        background-color: #f8d7da;
        border-left: 5px solid #dc3545;
        color: #721c24;
    }

    .notification.warning {
        background-color: #fff3cd;
        border-left: 5px solid #ffc107;
        color: #856404;
    }

    .notification.success {
        background-color: #d4edda;
        border-left: 5px solid #28a745;
        color: #155724;
    }

    .notification-content {
        display: flex;
        align-items: center;
    }

    .notification-icon {
        margin-right: 15px;
        font-size: 24px;
    }

    .notification-icon.error {
        color: #dc3545;
    }

    .notification-icon.warning {
        color: #ffc107;
    }

    .notification-icon.success {
        color: #28a745;
    }

    .notification-message {
        flex-grow: 1;
        font-size: 14px;
    }

    .notification-title {
        font-weight: bold;
        margin-bottom: 5px;
        font-size: 16px;
    }

    .notification-close {
        cursor: pointer;
        font-size: 18px;
        margin-left: 10px;
    }

    .notification-close.error {
        color: #721c24;
    }

    .notification-close.warning {
        color: #856404;
    }

    .notification-close.success {
        color: #155724;
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
</style>

<!-- Errores de codigo duplicado o stock  -->
<?php
    if (isset($_GET['error'])):
        if (!isset($_SESSION['codigo'])) {
            header("Location: ../login.php"); // Redirige al login si no hay sesión activa
            exit();
        }
        
        // Determinar el tipo de error para mostrar el título y estilo adecuados
        $errorMsg = $_GET['error'];
        $notificationType = "error"; // Por defecto es error
        
        // Determinar el título basado en el contenido del mensaje
        if (strpos($errorMsg, "stock") !== false || strpos($errorMsg, "inventario") !== false) {
            $notificationTitle = "Error de Stock";
        } elseif (strpos($errorMsg, "código de venta") !== false) {
            $notificationTitle = "Código Duplicado";
        } elseif (strpos($errorMsg, "usuario") !== false) {
            $notificationTitle = "Error de Usuario";
        } else {
            $notificationTitle = "Error";
        }
?>
    <div class="notification <?php echo $notificationType; ?>">
        <div class="notification-content">
            <div class="notification-icon <?php echo $notificationType; ?>">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="notification-message">
                <div class="notification-title"><?php echo $notificationTitle; ?></div>
                <div><?php echo htmlspecialchars($errorMsg); ?></div>
            </div>
            <div class="notification-close <?php echo $notificationType; ?>" onclick="this.parentElement.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div>
<?php endif; ?>

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
        <a href="../usuario/usuarios.php">
            <i class="fas fa-list"></i> Ver Usuarios
        </a>
        <a href="../usuario/usuario.php">
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
   <a href="ventas.php">
       <i class="fas fa-list"></i> Ver Ventas
   </a>
   <a href="venta.php">
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
        <h2 class="form-title">Registrar Nueva Venta</h2>
    <form action="insert_venta.php" method="post" class="mb-4">
    <div class="form-grid">
    <!-- Columna Izquierda -->
    <div class="form-column">
        <div class="form-group-modern">
            <label class="form-label">Código Venta</label>
            <input type="number" class="form-input" name="vent_codigo" required>
        </div>

        <div class="form-group-modern">
            <label class="form-label">Código Producto</label>
            <select class="form-input" name="prod_codigo" id="prod_codigo" required>
                <option value="">Código Producto</option>
                <?php
                require_once('../conexion.php');
                $con = connection();
                $sql_prod = "SELECT prod_codigo, prod_preciovent, prod_categoria FROM productos";
                $query_prod = mysqli_query($con, $sql_prod);
                while ($row = mysqli_fetch_assoc($query_prod)) {
                    echo "<option value='" . htmlspecialchars($row['prod_codigo']) . "' 
                        data-precio='" . htmlspecialchars($row['prod_preciovent']) . "' 
                        data-categoria='" . htmlspecialchars($row['prod_categoria']) . "'>" 
                        . htmlspecialchars($row['prod_codigo']) . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group-modern">
            <label class="form-label">Cantidad Vendida</label>
            <input type="number" class="form-input" name="vent_cantidad" required>
        </div>

        <div class="form-group-modern">
            <label class="form-label">Categoría Producto</label>
            <input type="text" class="form-input" name="prod_categoria" id="prod_categoria" readonly required>
        </div>
    </div>

    <!-- Columna Derecha -->
    <div class="form-column">
        <div class="form-group-modern">
            <label class="form-label">Precio Venta</label>
            <input type="text" class="form-input" name="prod_preciovent" id="prod_preciovent" readonly required>
        </div>

        <div class="form-group-modern">
            <label class="form-label">Método de Pago</label>
            <select class="form-input" name="vent_metodopago" required>
                <option value="">Método de Pago</option>
                <option value="Efectivo">Efectivo</option>
                <option value="Tarjeta Debito">Tarjeta Debito</option>
                <option value="Tarjeta Credito">Tarjeta Credito</option>
                <option value="Nequi">Nequi</option>
            </select>
        </div>

        <div class="form-group-modern">
            <label class="form-label">Fecha de Venta</label>
            <input type="date" class="form-input" name="vent_fechaventa" required>
        </div>

        <div class="form-group-modern">
            <label class="form-label">Código Usuario</label>
            <select class="form-input" name="codigo_usuario" required>
                <?php
                if (!isset($_SESSION['codigo'])) {
                    header("Location: ../login.php");
                    exit();
                }
                // Mostrar solo el código del usuario actual
                $user_codigo = $_SESSION['codigo'];
                echo "<option value='" . htmlspecialchars($user_codigo) . "'>" . htmlspecialchars($user_codigo) . "</option>";
                ?>
            </select>
        </div>
    </div>
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

<script>
// Script para que la notificación desaparezca después de 10 segundos
document.addEventListener('DOMContentLoaded', function() {
    const notification = document.querySelector('.notification');
    if(notification) {
        setTimeout(function() {
            notification.style.animation = 'slideOut 0.3s ease-in forwards';
            setTimeout(function() {
                notification.style.display = 'none';
            }, 300);
        }, 10000);
    }
});
</script>
<script>
// Script para autorellenar precio y categoría cuando se selecciona un producto
document.addEventListener('DOMContentLoaded', function() {
    const prodSelect = document.getElementById('prod_codigo');
    
    if (prodSelect) {
        prodSelect.addEventListener('change', function() {
            // Obtener los campos donde se mostrarán los datos
            const precioInput = document.getElementById('prod_preciovent');
            const categoriaInput = document.getElementById('prod_categoria');
            
            // Obtener la opción seleccionada
            const selectedOption = this.options[this.selectedIndex];
            
            if (selectedOption.value !== '') {
                // Obtener los datos de los atributos data-*
                const precio = selectedOption.getAttribute('data-precio');
                const categoria = selectedOption.getAttribute('data-categoria');
                
                // Establecer los valores en los campos correspondientes
                precioInput.value = precio;
                categoriaInput.value = categoria;
            } else {
                // Si no hay opción seleccionada, limpiar los campos
                precioInput.value = '';
                categoriaInput.value = '';
            }
        });
    }
});
</script>
<script src="../js/menu.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>