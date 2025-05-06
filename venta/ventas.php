<?php 
session_start();
include '../conexion.php';
if (isset($_GET['error'])):
    if (!isset($_SESSION['codigo'])) {
        header("Location: ../login.php"); // Redirige al login si no hay sesión activa
        exit();
    }
?>
    <div style="padding: 10px; background-color: #ffcccc; color: #cc0000; border-radius: 5px; margin-bottom: 15px;">
        <strong><?php echo htmlspecialchars($_GET['error']); ?></strong>
    </div>
<?php endif; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/boton.css">
    <link rel="stylesheet" href="../css/boton3.css">
    <link rel="stylesheet" href="../css/boton4.css">

</head>
<body>
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
<div class="table-container">
    <div class="form-group">
        <input type="text" id="searchInput" class="form-control" placeholder="Buscar por código o nombre">
    </div>
    <table class="table-moderna">
        <thead>
            <tr>
                <th>Código Venta</th>
                <th>Código producto</th>
                <th>Cantidad vendida</th>
                <th>Categoria Producto</th>
                <th>Precio Venta</th>
                <th>Método de Pago</th>
                <th>Fecha de Venta</th>
                <th>Código Usuario</th>
                <th>Acciones</th>
            </tr>
            </div>
        </thead>
        <tbody id="ventaTable">
            <?php
            include('../conexion.php');
            $con = connection();
            $sql = "SELECT * FROM venta";
            $query = mysqli_query($con, $sql);
            if (!$query) {
              die("Error en la consulta: " . mysqli_error($con));
          }
            while ($row = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>{$row['vent_codigo']}</td>";
                echo "<td>{$row['prod_codigo']}</td>";
                echo "<td>{$row['vent_cantidad']}</td>";
                echo "<td>{$row['prod_categoria']}</td>";
                echo "<td>{$row['prod_preciovent']}</td>";
                echo "<td>{$row['vent_metodopago']}</td>";
                echo "<td>{$row['vent_fechaventa']}</td>";
                echo "<td>{$row['user_codigo']}</td>";
                echo "<td>
                <a href='update_venta.php?vent_codigo=" . urlencode($row['vent_codigo']) . "' class='boton-editar'>
                      
                    <svg class='svg' viewBox='0 0 512 512'>
                        <path d='M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9
                        c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4
                        c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1 -8.5 5.4-13.3 6.9
                        L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3
                        33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25
                        25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6
                        0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z'></path>
                    </svg>
                </a> 
        
                <span style='margin: 0 5px;'></span>
        
                <a href='delete_venta.php?vent_codigo=" . urlencode($row['vent_codigo']) . "' class='boton-eliminar'>
                      
                    <svg class='svg' viewBox='0 0 512 512'>
                        <path d='M135.2 17.2L128 32H32V64H64V448C64 483.3 92.65 512 128 512H384C419.3 512 448 483.3 
                        448 448V64H480V32H384L376.8 17.2C372.5 7.25 362.5 0 352 0H160C149.5 0 139.5 7.25 135.2 
                        17.2zM128 64H384V448H128V64zM192 128V416H224V128H192zM288 128V416H320V128H288z'></path>
                    </svg>
                </a>
            </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
  

<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#ventaTable tr");

        rows.forEach(row => {
            let vent_codigo = row.cells[0].textContent.toLowerCase();
            let user_codigo = row.cells[1].textContent.toLowerCase();

            if (vent_codigo.includes(filter) || user_codigo.includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
</script>
<script src="../js/menu.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>