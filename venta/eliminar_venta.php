<?php
if(isset($_POST['submit'])) {
    
    $vent_codigo = $_POST['vent_codigo'];

    include('../conexion.php');
    $conn = connection();

    // Obtener la cantidad vendida y el código del producto antes de eliminar
    $sql_select = "SELECT prod_codigo, vent_cantidad FROM venta WHERE vent_codigo = ?";
    $stmt_select = mysqli_prepare($conn, $sql_select);
    mysqli_stmt_bind_param($stmt_select, "s", $vent_codigo);
    mysqli_stmt_execute($stmt_select);
    $result = mysqli_stmt_get_result($stmt_select);
    $venta = mysqli_fetch_assoc($result);

    if ($venta) {
        $prod_codigo = $venta['prod_codigo'];
        $vent_cantidad = $venta['vent_cantidad'];

        // Devolver la cantidad al stock del producto
        $sql_update = "UPDATE productos SET prod_stock = prod_stock + ? WHERE prod_codigo = ?";
        $stmt_update = mysqli_prepare($conn, $sql_update);
        mysqli_stmt_bind_param($stmt_update, "is", $vent_cantidad, $prod_codigo);
        mysqli_stmt_execute($stmt_update);
    }

    // Ahora eliminar la venta
    $sql_delete = "DELETE FROM venta WHERE vent_codigo = ?";
    $stmt_delete = mysqli_prepare($conn, $sql_delete);
    mysqli_stmt_bind_param($stmt_delete, "s", $vent_codigo);
    $query = mysqli_stmt_execute($stmt_delete);

    if($query) {
        echo "Venta eliminada correctamente.";
        Header("Location: ventas.php");
    } else {
        echo "Error al eliminar la venta";
    }

    // Cerrar conexiones
    mysqli_stmt_close($stmt_select);
    mysqli_stmt_close($stmt_update);
    mysqli_stmt_close($stmt_delete);
    mysqli_close($conn);
}
?>
