<?php
include('../conexion.php');
$con = connection();

$vent_codigo = $_POST['vent_codigo'];
$prod_codigo = $_POST['prod_codigo'];
$nueva_cantidad = $_POST['vent_cantidad'];
$prod_categoria = $_POST['prod_categoria'];
$prod_preciovent = $_POST['prod_preciovent'];
$vent_metodopago = $_POST['vent_metodopago'];
$vent_fechaventa = $_POST['vent_fechaventa'];
$user_codigo = $_POST['user_codigo'];

// Obtener la cantidad anterior de la venta
$sql_old = "SELECT vent_cantidad FROM venta WHERE vent_codigo='$vent_codigo'";
$result_old = mysqli_query($con, $sql_old);
$row_old = mysqli_fetch_assoc($result_old);
$cantidad_anterior = $row_old['vent_cantidad'];

// Calcular la diferencia de stock
$diferencia = $nueva_cantidad - $cantidad_anterior;

// Obtener el stock actual del producto
$sql_stock_check = "SELECT prod_stock FROM productos WHERE prod_codigo='$prod_codigo'";
$result_stock_check = mysqli_query($con, $sql_stock_check);
$row_stock = mysqli_fetch_assoc($result_stock_check);
$stock_actual = $row_stock['prod_stock'];

// Verificar que la nueva cantidad no supere el stock disponible
if ($diferencia > $stock_actual) {
    echo "<script>alert('Error: La cantidad vendida supera el stock disponible.'); window.location.href='venta.php';</script>";
    exit();
}

// Actualizar la cantidad en la tabla venta
$sql_update = "UPDATE venta SET 
    prod_codigo = '$prod_codigo', 
    vent_cantidad = '$nueva_cantidad',
    prod_categoria = '$prod_categoria', 
    prod_preciovent = '$prod_preciovent', 
    vent_metodopago = '$vent_metodopago', 
    vent_fechaventa = '$vent_fechaventa', 
    user_codigo = '$user_codigo'
WHERE vent_codigo ='$vent_codigo'";
$query_update = mysqli_query($con, $sql_update);

// Actualizar el stock en la tabla productos
if ($query_update) {
    $sql_stock = "UPDATE productos SET prod_stock = prod_stock - '$diferencia' WHERE prod_codigo='$prod_codigo'";
    mysqli_query($con, $sql_stock);

    Header("Location: ventas.php");
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);
?>
