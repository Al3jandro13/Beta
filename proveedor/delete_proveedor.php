<?php
session_start();
include('../conexion.php');

$con = connection();
if (!isset($_SESSION['codigo'])) {
    header("Location: ../login.php"); // Redirige al login si no hay sesión activa
    exit();
}
$sql = "SELECT * FROM proveedor";
$query = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Proveedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/delete.css" rel="stylesheet">
</head>
<body>
<div class="row justify-content-center mt-5">
            <div class="col-md-6">
    <div class="text-center">
    <h2>Eliminar Proveedor</h2>
    <form action="eliminar_proveedor.php" method="post">
    <div class="mb-3">
        <label for="prov_codigo">Que Dato Quieres Eliminar:</label>
        <input type="text" id="prov_codigo" name="prov_codigo" class="form-control" required><br><br>

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
                    <h2 class="text-center">Proveedores</h2>
                    <table class="table" >
                        <thead>
                            <tr>
                            <th>Código</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Direccion</th>
                <th>Nit</th>
                <th>Categoria</th>
                
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_array($query)): ?> 
                                <tr> 
                                    <td><?=$row['prov_codigo'] ?></td> 
                                    <td><?=$row['prov_nombre'] ?></td>
                                    <td><?=$row['prov_telefono'] ?></td>
                                    <td><?=$row['prov_correo'] ?></td>
                                    <td><?=$row['prov_direccion'] ?></td>
                                    <td><?=$row['prov_nit'] ?></td>
                                    <td><?=$row['prov_categoria'] ?></td>
                                    <td><a href="update_proveedor.php?prov_codigo=<?= $row['prov_codigo'] ?>" class="btn btn-warning">Editar</a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
    
</body>
</html>