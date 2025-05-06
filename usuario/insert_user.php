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

    // Manejo de imagen local (sin relación con la base de datos)
    if (isset($_FILES['user_imagen']) && $_FILES['user_imagen']['error'] == 0) {
        $imagen = $_FILES['user_imagen'];
        $tipo_imagen = mime_content_type($imagen['tmp_name']);

        // Verificar que es imagen
        if (strpos($tipo_imagen, 'image') !== false) {
            $nombre_unico = uniqid() . '_' . basename($imagen['name']);
            $ruta_destino = '../assets_usuario/' . $nombre_unico;

            // Mover la imagen al destino
            move_uploaded_file($imagen['tmp_name'], $ruta_destino);
        }
    }

    $conn = connection();

$sql = "INSERT INTO usuario (codigo, user_nombre, user_apellido, user_contra, user_cc, user_fechanac, user_tel, user_correo, user_rol) 
VALUES ('$codigo', '$user_nombre', '$user_apellido', '$user_contra', '$user_cc', '$user_fechanac', '$user_tel' , '$user_correo', '$user_rol' )";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: usuarios.php");
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);
?>