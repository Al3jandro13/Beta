<?php
session_start();
include('../conexion.php');
$con = connection();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['codigo'])) {
    header("Location: ../login.php");
    exit();
}

// Verificar que todos los campos estén llenos
if (
    !isset($_POST['vent_codigo'], $_POST['prod_codigo'], $_POST['vent_cantidad'], $_POST['prod_categoria'], 
            $_POST['prod_preciovent'], $_POST['vent_metodopago'], $_POST['vent_fechaventa'], $_POST['codigo_usuario']) || 
    empty($_POST['vent_codigo']) || empty($_POST['prod_codigo']) || empty($_POST['vent_cantidad']) || 
    empty($_POST['prod_categoria']) || empty($_POST['prod_preciovent']) || empty($_POST['vent_metodopago']) || 
    empty($_POST['vent_fechaventa']) || empty($_POST['codigo_usuario'])
) {
    header("Location: venta.php?error=Todos los campos obligatorios deben estar llenos.");
    exit();
}

// Prevenir inyección SQL 
$vent_codigo = mysqli_real_escape_string($con, $_POST['vent_codigo']);
$prod_codigo = mysqli_real_escape_string($con, $_POST['prod_codigo']);
$vent_cantidad = mysqli_real_escape_string($con, $_POST['vent_cantidad']);
$prod_categoria = mysqli_real_escape_string($con, $_POST['prod_categoria']);
$prod_preciovent = mysqli_real_escape_string($con, $_POST['prod_preciovent']);
$vent_metodopago = mysqli_real_escape_string($con, $_POST['vent_metodopago']);
$vent_fechaventa = mysqli_real_escape_string($con, $_POST['vent_fechaventa']);
$user_codigo = mysqli_real_escape_string($con, $_POST['codigo_usuario']);

// Verificar que el código del usuario coincida con el usuario actual
if ($user_codigo != $_SESSION['codigo']) {
    header("Location: venta.php?error=No puedes hacer ventas con un código de usuario diferente al tuyo.");
    exit();
}

// Verificar si el código de venta ya existe
$check_venta = "SELECT vent_codigo FROM venta WHERE vent_codigo = '$vent_codigo'";
$result_venta = mysqli_query($con, $check_venta);

if (mysqli_num_rows($result_venta) > 0) {
    header("Location: venta.php?error=El código de venta $vent_codigo ya existe. Por favor utilice un código diferente.");
    exit();
}

// Verificar el stock del producto antes de realizar la venta
$check_stock = "SELECT prod_stock FROM productos WHERE prod_codigo = '$prod_codigo'";
$result_stock = mysqli_query($con, $check_stock);
$row = mysqli_fetch_assoc($result_stock);

if (!$row) {
    header("Location: venta.php?error=El producto con código $prod_codigo no existe.");
    exit();
}

$stock_disponible = $row['prod_stock'];

if ($stock_disponible < $vent_cantidad) {
    header("Location: venta.php?error=No hay suficiente stock disponible. Lo sentimos, pero la cantidad solicitada supera nuestro inventario actual.");
    exit();
}

// Insertar la venta
$sql = "INSERT INTO venta (vent_codigo, prod_codigo, vent_cantidad, prod_categoria, prod_preciovent, vent_metodopago, vent_fechaventa, user_codigo) 
VALUES ('$vent_codigo', '$prod_codigo', '$vent_cantidad', '$prod_categoria', '$prod_preciovent', '$vent_metodopago', '$vent_fechaventa', '$user_codigo')";

$query = mysqli_query($con, $sql);

if ($query) {
    // Actualizar el stock en la tabla productos
    $update_stock_sql = "UPDATE productos SET prod_stock = prod_stock - '$vent_cantidad' WHERE prod_codigo = '$prod_codigo'";
    mysqli_query($con, $update_stock_sql);
    
    // Redirigir sin mensaje de éxito
    header("Location: ventas.php");
    exit();
} else {
    header("Location: ventas.php?error=Error en la inserción: " . mysqli_error($con));
    exit();
}

mysqli_close($con);
?>