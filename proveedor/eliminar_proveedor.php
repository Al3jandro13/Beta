<?php
if(isset($_POST['submit'])) {
    
    $prov_codigo = $_POST['prov_codigo'];

   
    include('../conexion.php');
    $conn = connection();

    
    $sql = "DELETE FROM proveedor WHERE prov_codigo = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $prov_codigo);
    $query = mysqli_stmt_execute($stmt);

   
    if($query) {
        echo "proveedor eliminado correctamente.";
        Header("Location: proveedores.php");
    } else {
        echo "Error al eliminar el proveedor.";
    }

   
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}