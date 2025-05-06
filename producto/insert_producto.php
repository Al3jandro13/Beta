<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prod_codigo = $_POST['prod_codigo'];
    $prod_nombre = $_POST['prod_nombre'];
    $prod_categoria = $_POST['prod_categoria'];
    $prod_preciocomp = $_POST['prod_preciocomp'];
    $prod_preciovent = $_POST['prod_preciovent'];
    $prod_talla = $_POST['prod_talla'];
    $prod_color = $_POST['prod_color'];
    $prod_stock = $_POST['prod_stock'];
    $prov_codigo = $_POST['prov_codigo'];

    // Manejo de imagen local (sin relación con la base de datos)
    if (isset($_FILES['prod_imagen']) && $_FILES['prod_imagen']['error'] == 0) {
        $imagen = $_FILES['prod_imagen'];
        $tipo_imagen = mime_content_type($imagen['tmp_name']);

        // Verificar que es imagen
        if (strpos($tipo_imagen, 'image') !== false) {
            $nombre_unico = uniqid() . '_' . basename($imagen['name']);
            $ruta_destino = '../assets_producto/' . $nombre_unico;

            // Mover la imagen al destino
            move_uploaded_file($imagen['tmp_name'], $ruta_destino);
        }
    }

    $conn = connection();

    // Verificar existencia del proveedor
    $query_verificar = "SELECT COUNT(*) as count FROM proveedor WHERE prov_codigo = ?";
    $stmt_verificar = $conn->prepare($query_verificar);
    $stmt_verificar->bind_param("i", $prov_codigo);
    $stmt_verificar->execute();
    $result_verificar = $stmt_verificar->get_result();
    $row_verificar = $result_verificar->fetch_assoc();

    if ($row_verificar['count'] == 0) {
        header("Location: productos.php");
        exit();
    }

    // Insertar producto (sin incluir imagen)
    $query_insertar = "INSERT INTO productos (
        prod_codigo, prod_nombre, prod_categoria, prod_preciocomp, prod_preciovent, 
        prod_talla, prod_color, prod_stock, prov_codigo
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt_insertar = $conn->prepare($query_insertar);
    $stmt_insertar->bind_param(
        "issddssii",
        $prod_codigo, $prod_nombre, $prod_categoria, $prod_preciocomp,
        $prod_preciovent, $prod_talla, $prod_color, $prod_stock, $prov_codigo
    );
    $stmt_insertar->execute();

    $stmt_insertar->close();
    $stmt_verificar->close();
    $conn->close();

    header("Location: productos.php");
    exit();
}
?>
