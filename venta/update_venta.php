<?php
session_start();
include('../conexion.php');
$con = connection();
if (!isset($_SESSION['codigo'])) {
    header("Location: ../login.php"); // Redirige al login si no hay sesión activa
    exit();
}
$vent_codigo = $_GET['vent_codigo'];
$sql = "SELECT * FROM venta WHERE vent_codigo='$vent_codigo'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Venta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/update.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Editar Venta</h2>

    <form action="edit_venta.php" method="post" id="venta">
        <div class="form-group">
            <input type="hidden" name="vent_codigo" value="<?php echo $row['vent_codigo']; ?>">

            <div class="form-group">
            <label>Código venta</label>
                <input type="number" class="form-control" value="<?php echo $row['vent_codigo']; ?>" readonly>
            </div>
            <div class="form-group">
            <label>Código producto</label>
                <input type="number" class="form-control" name="prod_codigo" value="<?php echo $row['prod_codigo']; ?>" required>
            </div>
            <div class="form-group">
            <label>Cantidad Vendida</label>
                <input type="number" class="form-control" name="vent_cantidad" value="<?php echo $row['vent_cantidad']; ?>" required>
            </div>
            <div class="form-group">
            <label>Categoria Producto</label>
                <input type="text" class="form-control" name="prod_categoria" value="<?php echo $row['prod_categoria']; ?>" required>
            </div>
            <div class="form-group">
            <label>Precio de venta</label>
                <input type="number" class="form-control" name="prod_preciovent" value="<?php echo $row['prod_preciovent']; ?>" required>
            </div>
            <div class="form-group">
            <label>Metodo de pago</label>
                <input type="text" class="form-control" name="vent_metodopago" value="<?php echo $row['vent_metodopago']; ?>" required>
            </div>
            <div class="form-group">
            <label>Fecha de venta</label>
                <input type="date" class="form-control" name="vent_fechaventa" value="<?php echo $row['vent_fechaventa']; ?>" required>
            </div>
            <div class="form-group">
            <label>Código usuario</label>
                <input type="number" class="form-control" name="user_codigo" value="<?php echo $row['user_codigo']; ?>" required>
            </div>
        </div>
        <button type="button" class="btn btn-primary mt-3" onclick="confirmUpdate()">Actualizar venta</button>
        </form>
    </div>




    <script>
        function confirmUpdate() {
            if (confirm("¿Estás seguro de que deseas actualizar este venta?")) {
                document.getElementById("venta").submit();
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

