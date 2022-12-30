<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "ctf_acreditaciones";

// Establecemos una conexión a la base de datos
$conexion = mysqli_connect($host, $user, $pass, $dbname);
// Para admitir caracteres espaciales como tiles o ñ
mysqli_set_charset($conexion, 'utf8mb4');

// Verificamos si se ha producido un error al conectarnos
if (mysqli_connect_errno()) {
  // Si se ha producido un error, mostramos un mensaje y terminamos la ejecución del script
  die("Error al conectarse a la base de datos: " . mysqli_connect_error());
}

?>