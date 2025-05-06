<?php
if(isset($_POST['submit'])) {
    
    $prod_codigo = $_POST['prod_codigo'];

   
    include('../conexion.php');
    $conn = connection();

    
    $sql = "DELETE FROM productos WHERE prod_codigo = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $prod_codigo);
    $query = mysqli_stmt_execute($stmt);

   
    if($query) {
        echo "Usuario eliminado correctamente.";
        Header("Location: productos.php");
    } else {
        echo "Error al eliminar el producto.";
    }

   
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>