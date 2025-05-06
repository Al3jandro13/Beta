<?php
session_start();
include('../conexion.php');
$con = connection();
if (!isset($_SESSION['codigo'])) {
    header("Location: ../login.php"); // Redirige al login si no hay sesión activa
    exit();
}

$prod_codigo = $_GET['prod_codigo'];
$sql = "SELECT * FROM productos WHERE prod_codigo='$prod_codigo'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/update.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Editar Producto</h2>

    <form action="edit_producto.php" method="post" id="producto">
        <div class="form-group">
            <input type="hidden" name="prod_codigo" value="<?php echo $row['prod_codigo']; ?>">

            <div class="form-group">
            <label>Código Producto</label>
                <input type="number" class="form-control" value="<?php echo $row['prod_codigo']; ?>" readonly>
            </div>
            <div class="form-group">
            <label>Nombre Producto</label>
                <input type="text" class="form-control" name="prod_nombre" value="<?php echo $row['prod_nombre']; ?>" required>
            </div>
            <div class="form-group">
            <label>Producto Proveedor</label>
                <input type="text" class="form-control" name="prod_categoria" value="<?php echo $row['prod_categoria']; ?>" required>
            </div>
            <div class="form-group">
            <label>Costo Compra Producto</label>
                <input type="number" class="form-control" name="prod_preciocomp" value="<?php echo $row['prod_preciocomp']; ?>" required>
            </div>
            <div class="form-group">
            <label>Precio Venta Producto</label>
                <input type="number" class="form-control" name="prod_preciovent" value="<?php echo $row['prod_preciovent']; ?>" required>
            </div>
            <div class="form-group">
            <label>Talla Producto</label>
                <input type="text" class="form-control" name="prod_talla" value="<?php echo $row['prod_talla']; ?>" required>
            </div>
            <div class="form-group">
            <label>Color Producto</label>
                <input type="text" class="form-control" name="prod_color" value="<?php echo $row['prod_color']; ?>" required>
            </div>
            <div class="form-group">
            <label>Stock Producto</label>
                <input type="number" class="form-control" name="prod_stock" value="<?php echo $row['prod_stock']; ?>" required>
            </div>
            <div class="form-group">
            <label>Código Proveedor</label>
                <input type="number" class="form-control" name="prov_codigo" value="<?php echo $row['prov_codigo']; ?>" required>
            </div>
        </div>
        <button type="button" class="btn btn-primary mt-3" onclick="confirmUpdate()">Actualizar Producto</button>
        </form>
    </div>

    <script>
        function confirmUpdate() {
            if (confirm("¿Estás seguro de que deseas actualizar este producto?")) {
                document.getElementById("producto").submit();
            }
        }
    </script>
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

