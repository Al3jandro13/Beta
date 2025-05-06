<?php
session_start();
include('../conexion.php');

$con = connection();
if (!isset($_SESSION['codigo'])) {
    header("Location: ../login.php"); // Redirige al login si no hay sesión activa
    exit();
}
$sql = "SELECT * FROM productos";
$query = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/delete.css" rel="stylesheet">
</head>
<body>
<div class="row justify-content-center mt-5">
            <div class="col-md-6">
    <div class="text-center">
    <h2>Eliminar Producto</h2>
    <form action="eliminar_producto.php" method="post" id="deleteform">
    <div class="mb-3">
        <label for="prod_codigo">Que Producto Quieres Eliminar:</label>
        <input type="text" id="prod_codigo" name="prod_codigo" class="form-control" required><br><br>

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
                    <h2 class="text-center">Productos</h2>
                    <table class="table" >
                        <thead>
                            <tr>
                            <th>Código</th>
                <th>Nombre Producto</th>
                <th>Categoria Producto</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Talla</th>
                <th>Color</th>
                <th>Stock</th>
                <th>Código proveedor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_array($query)): ?> 
                                <tr> 
                                    <td><?=$row['prod_codigo'] ?></td> 
                                    <td><?=$row['prod_nombre'] ?></td>
                                    <td><?=$row['prod_categoria'] ?></td>
                                    <td><?=$row['prod_preciocomp'] ?></td>
                                    <td><?=$row['prod_preciovent'] ?></td>
                                    <td><?=$row['prod_talla'] ?></td>
                                    <td><?=$row['prod_color'] ?></td>
                                    <td><?=$row['prod_stock'] ?></td>
                                    <td><?=$row['prov_codigo'] ?></td>
                                    <td><a href="update_producto.php?prod_codigo=<?= $row['prod_codigo'] ?>" class="btn btn-warning">Editar</a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
    
</body>
</html>