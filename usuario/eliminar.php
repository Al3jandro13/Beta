<?php
if(isset($_POST['submit'])) {
    
    $codigo = $_POST['codigo'];

   
    include('../conexion.php');
    $conn = connection();

    
    $sql = "DELETE FROM usuario WHERE codigo = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $codigo);
    $query = mysqli_stmt_execute($stmt);

   
    if($query) {
        echo "Usuario eliminado correctamente.";
        Header("Location: usuarios.php");
    } else {
        echo "Error al eliminar el usuario.";
    }

   
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>