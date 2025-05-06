<?php
include('../conexion.php');
$con = connection();

$prov_codigo = $_POST['prov_codigo'];
$prov_nombre = $_POST['prov_nombre'];
$prov_telefono = $_POST['prov_telefono'];
$prov_correo = $_POST['prov_correo'];
$prov_direccion = $_POST['prov_direccion'];
$prov_nit = $_POST['prov_nit'];
$prov_categoria = $_POST['prov_categoria'];


$sql = "INSERT INTO proveedor (prov_codigo, prov_nombre, prov_telefono, prov_correo, prov_direccion, prov_nit, prov_categoria) 
VALUES ('$prov_codigo', '$prov_nombre', '$prov_telefono', '$prov_correo', '$prov_direccion', '$prov_nit', '$prov_categoria' ) ";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: proveedores.php");
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);
?>
