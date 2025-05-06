<?php
session_start();
include('../conexion.php');
$con = connection();
if (!isset($_SESSION['codigo'])) {
    header("Location: ../login.php"); // Redirige al login si no hay sesión activa
    exit();
}
$codigo = $_GET['codigo'];
$sql = "SELECT * FROM usuario WHERE codigo='$codigo'";
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
        <h2 class="mb-4">Editar Usuario</h2>

        <form action="edit_user.php" method="post" id="updateForm">
            <input type="hidden" name="codigo" value="<?php echo $row['codigo']; ?>">
            
            <div class="form-group">
                <label>Código</label>
                <input type="number" class="form-control" value="<?php echo $row['codigo']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" name="user_nombre" value="<?php echo $row['user_nombre']; ?>" required>
            </div>
            <div class="form-group">
                <label>Apellido</label>
                <input type="text" class="form-control" name="user_apellido" value="<?php echo $row['user_apellido']; ?>" required>
            </div>
            <div class="form-group">
                <label>Nueva Contraseña</label>
                <input type="password" class="form-control" name="user_contra">
                <small>Déjalo vacío si no deseas cambiarla.</small>
            </div>
            <div class="form-group">
                <label>Cédula</label>
                <input type="number" class="form-control" name="user_cc" value="<?php echo $row['user_cc']; ?>" required>
            </div>
            <div class="form-group">
                <label>Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="user_fechanac" value="<?php echo $row['user_fechanac']; ?>" required>
            </div>
            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" class="form-control" name="user_tel" value="<?php echo $row['user_tel']; ?>" required>
            </div>
            <div class="form-group">
                <label>Correo</label>
                <input type="email" class="form-control" name="user_correo" value="<?php echo $row['user_correo']; ?>" required>
            </div>
            <div class="form-group">
                <label>Rol</label>
                <input type="text" class="form-control" name="user_rol" value="<?php echo $row['user_rol']; ?>" required>
            </div>

            <button type="button" class="btn btn-primary mt-3" onclick="confirmUpdate()">Actualizar Usuario</button>
        </form>
    </div>

    <script>
        function confirmUpdate() {
            if (confirm("¿Estás seguro de que deseas actualizar este usuario?")) {
                document.getElementById("updateForm").submit();
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
