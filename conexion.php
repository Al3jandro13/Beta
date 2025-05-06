<?php 
// Evita que el archivo se cargue más de una vez
if (!function_exists('connection')) {
    function connection() {
        static $connect = null; // Solo permite una conexión activa

        if ($connect === null) {
            $host = "localhost";
            $user = "root";
            $pass = "";
            $bd = "elite_sport";

            $connect = mysqli_connect($host, $user, $pass, $bd);

            if (!$connect) {
                die("Error de conexión: " . mysqli_connect_error());
            }
        }

        return $connect;
    }
}
?>