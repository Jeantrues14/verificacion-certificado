<?php
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
$apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING);
$rol = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

  // Valida los datos del formulario
  if (!is_string($usuario) || !is_string($nombre) || !is_string($apellido) || !is_string($rol) | !is_string($password)) {
      die("Error al registrar usuario");
  }

// Abre una conexión a la base de datos
include "../database/conexion.php";

// Crea una consulta SQL para insertar el usuario en la tabla de usuarios
$query = "INSERT INTO usuarios (nombre, apellido, usuario, rol, password)
          VALUES ('$nombre', '$apellido', '$usuario', '$rol', '$password')";

// Ejecuta la consulta y comprueba si se ha ejecutado correctamente
if (mysqli_query($conexion, $query)) {
  // Si se ha ejecutado correctamente, redirige al usuario a la página de inicio
  header('Location: ../usuarios.php');
} else {
  // Si ha habido un error, muestra un mensaje de error
  echo 'Error: ' . mysqli_error($conexion);
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>