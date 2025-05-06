<?php
include('../conexion.php');
$con = connection();

$codigo = $_POST['codigo'];
$user_nombre = $_POST['user_nombre'];
$user_apellido = $_POST['user_apellido'];
$user_contra = $_POST['user_contra'];
$user_cc = $_POST['user_cc'];
$user_fechanac = $_POST['user_fechanac'];
$user_tel = $_POST['user_tel'];
$user_correo = $_POST['user_correo'];
$user_rol = $_POST['user_rol'];
if (empty($user_contra)) {
    // Obtener la contraseña actual de la base de datos
    $sql = "SELECT user_contra FROM usuario WHERE codigo = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $codigo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $user_contra = $row['user_contra']; // Mantener la contraseña actual
    mysqli_stmt_close($stmt);
}

$sql = "UPDATE usuario SET user_nombre = '$user_nombre', user_apellido = '$user_apellido', user_contra = '$user_contra', user_cc = '$user_cc', user_fechanac = '$user_fechanac', user_tel = '$user_tel', user_correo = '$user_correo', user_rol = '$user_rol' WHERE codigo='$codigo'";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: usuarios.php");
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);
?>

