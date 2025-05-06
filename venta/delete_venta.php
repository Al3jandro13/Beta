<?php
session_start();
include('../conexion.php');
if (!isset($_SESSION['codigo'])) {
    header("Location: ../login.php"); // Redirige al login si no hay sesión activa
    exit();
}

$con = connection();

$sql = "SELECT * FROM venta";
$query = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/delete.css">
</head>
<body>
<div class="row justify-content-center mt-5">
            <div class="col-md-6">
    <div class="text-center">
    <h2>Eliminar Vena</h2>
    <form action="eliminar_venta.php" method="post">
    <div class="mb-3">
        <label for="vent_codigo">Que Venta Quieres Eliminar:</label>
        <input type="text" id="vent_codigo" name="vent_codigo" class="form-control" required><br><br>

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
                    <h2 class="text-center">Ventas</h2>
                    <table class="table" >
                        <thead>
                            <tr>
                            <th>Código Venta</th>
                <th>Código Producto</th>
                <th>Cantidad Vendida</th>
                <th>Categoria</th>
                <th>Precio Venta</th>
                <th>Metodo de Pago</th>
                <th>Fecha Venta</th>
                <th>Codigo Usuario</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_array($query)): ?> 
                                <tr> 
                                    <td><?=$row['vent_codigo'] ?></td> 
                                    <td><?=$row['prod_codigo'] ?></td>
                                    <td><?=$row['vent_cantidad'] ?></td>
                                    <td><?=$row['prod_categoria'] ?></td>
                                    <td><?=$row['prod_preciovent'] ?></td>
                                    <td><?=$row['vent_metodopago'] ?></td>
                                    <td><?=$row['vent_fechaventa'] ?></td>
                                    <td><?=$row['user_codigo'] ?></td>
                                    <td><a href="update_venta.php?vent_codigo=<?= $row['vent_codigo'] ?>" class="btn btn-warning">Editar</a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
    
</body>
</html>