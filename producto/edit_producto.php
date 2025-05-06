<?php
include('../conexion.php');
$con = connection();

$prod_codigo = $_POST['prod_codigo'];
$prod_nombre = $_POST['prod_nombre'];
$prod_categoria = $_POST['prod_categoria'];
$prod_preciocomp = $_POST['prod_preciocomp'];
$prod_preciovent = $_POST['prod_preciovent'];
$prod_talla = $_POST['prod_talla'];
$prod_color = $_POST['prod_color'];
$prod_stock = $_POST['prod_stock'];
$prov_codigo = $_POST['prov_codigo'];

$sql = "UPDATE productos SET prod_nombre = '$prod_nombre', prod_categoria = '$prod_categoria', prod_preciocomp = '$prod_preciocomp', prod_preciovent = '$prod_preciovent', prod_talla = '$prod_talla', prod_color = '$prod_color', prod_stock = '$prod_stock', prov_codigo = '$prov_codigo' WHERE prod_codigo='$prod_codigo'";

$query = mysqli_query($con, $sql) or die("Error en la consulta: " . mysqli_error($con));

if ($query) {
    Header("Location: productos.php");
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);
?>