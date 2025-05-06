<?php
session_start();
include 'conexion.php'; // Incluir conexión a la BD
$conexion = connection(); // Obtener conexión

$error = ""; // Variable para errores

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_nombre = trim($_POST['user_nombre']);
    $user_contra = trim($_POST['user_contra']);

    // Verificar si los campos están vacíos
    if (empty($user_nombre) || empty($user_contra)) {
        $error = "Por favor, completa todos los campos.";
    } else {
        // Consulta para verificar usuario y contraseña
        $sql = "SELECT * FROM usuario WHERE user_nombre = '$user_nombre' AND user_contra = '$user_contra'";
        $query = mysqli_query($conexion, $sql);

        if (!$query) {
            $error = "Error en la consulta: " . mysqli_error($conexion);
        } else {
            $usuario = mysqli_fetch_assoc($query);

            if ($usuario) {
                $_SESSION['codigo'] = $usuario['codigo']; // ID del usuario
                $_SESSION['user_nombre'] = $usuario['user_nombre']; // Nombre de usuario

                // Redirigir al usuario a index.php
                echo "<script>window.location.href = 'index.php';</script>";
                exit();
            } else {
                $error = "Usuario o contraseña incorrectos.";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <main class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="user_nombre" required placeholder="Ingresa tu usuario" autocomplete="username">
            </div>
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="user_contra" required placeholder="Ingresa tu contraseña" autocomplete="current-password">
            </div>
            <button type="submit" class="btn">Ingresar</button>
        </form>

        <?php if ($error): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
    </main>
</body>
</html>

