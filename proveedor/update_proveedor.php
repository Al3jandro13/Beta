<?php
session_start();
include('../conexion.php');
$con = connection();
if (!isset($_SESSION['codigo'])) {
    header("Location: ../login.php"); // Redirige al login si no hay sesión activa
    exit();
}
$prov_codigo  = $_GET['prov_codigo'];
$sql = "SELECT * FROM proveedor WHERE prov_codigo='$prov_codigo'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/update.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Editar Proveedor</h2>

    <form action="edit_proveedor.php" method="post" id="prov">
        <div class="form-group">
            <input type="hidden" name="prov_codigo" value="<?php echo $row['prov_codigo']; ?>">

            <div class="form-group">
            <label>Código Proveedor</label>
                <input type="number" class="form-control" value="<?php echo $row['prov_codigo']; ?>" readonly>
            </div>
            <div class="form-group">
            <label>Nombre Proveedor</label>
                <input type="text" class="form-control" name="prov_nombre" value="<?php echo $row['prov_nombre']; ?>" required>
            </div>
            <div class="form-group">
            <label>Telefono Proveedor</label>
                <input type="number" class="form-control" name="prov_telefono" value="<?php echo $row['prov_telefono']; ?>" required>
            </div>
            <div class="form-group">
            <label>Correo Proveedor</label>
                <input type="email" class="form-control" name="prov_correo" value="<?php echo $row['prov_correo']; ?>" required>
            </div>
            <div class="form-group">
            <label>Dirección Proveedor</label>
                <input type="text" class="form-control" name="prov_direccion" value="<?php echo $row['prov_direccion']; ?>" required>
            </div>
            <div class="form-group">
            <label>NIT</label>
                <input type="number" class="form-control" name="prov_nit" value="<?php echo $row['prov_nit']; ?>" required>
            </div>
            <div class="form-group">
            <label>Categoria</label>
                <input type="text" class="form-control" name="prov_categoria" value="<?php echo $row['prov_categoria']; ?>" required>
            </div>
        </div>
        <button type="button" class="btn btn-primary mt-3" onclick="confirmUpdate()">Actualizar Proveedor</button>
        </form>
    </div>




    <script>
        function confirmUpdate() {
            if (confirm("¿Estás seguro de que deseas actualizar este proveedor?")) {
                document.getElementById("prov").submit();
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

