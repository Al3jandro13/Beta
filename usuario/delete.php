<?php
session_start();
include('../conexion.php');

$con = connection();
if (!isset($_SESSION['codigo'])) {
    header("Location: ../login.php"); // Redirige al login si no hay sesión activa
    exit();
}
$sql = "SELECT * FROM usuario";
$query = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/delete.css" rel="stylesheet">
</head>
<body>
<div class="row justify-content-center mt-5">
            <div class="col-md-6">
    <div class="text-center">
    <h2>Eliminar Usuario</h2>
    <form action="eliminar.php" method="post">
    <div class="mb-3">
        <label for="codigo">Que Dato Quieres Eliminar:</label>
        <input type="text" id="codigo" name="codigo" class="form-control" required><br><br>

        <input type="submit" value="Eliminar" name="submit" class="btn btn-danger">
    </form>
    <script>
        function confirmDelete (){
            if (confirm("¿Estas Seguro Que Quieres Eliminar Esto?")){
                document.getElementById("deleteform").submit();
            }
        }
    </script>
    <div class="row mt-5">
                <div class="col-md-12">
                    <h2 class="text-center">Usuarios</h2>
                    <table class="table" >
                        <thead>
                            <tr>
                            <th>Código</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Contraseña</th>
                <th>Cedula</th>
                <th>Fecha de naciemiento</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Rol</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_array($query)): ?> 
                                <tr> 
                                    <td><?=$row['codigo'] ?></td> 
                                    <td><?=$row['user_nombre'] ?></td>
                                    <td><?=$row['user_apellido'] ?></td>
                                    <td><?=$row['user_contra'] ?></td>
                                    <td><?=$row['user_cc'] ?></td>
                                    <td><?=$row['user_fechanac'] ?></td>
                                    <td><?=$row['user_tel'] ?></td>
                                    <td><?=$row['user_correo'] ?></td>
                                    <td><?=$row['user_rol'] ?></td>
                                    <td><a href="update.php?codigo=<?= $row['codigo'] ?>" class="btn btn-warning">Editar</a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
    
</body>
</html>