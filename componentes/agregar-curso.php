<?php
$nombre_curso = filter_input(INPUT_POST, 'nombre_curso', FILTER_SANITIZE_STRING);

  // Valida los datos del formulario
  if (!is_string($nombre_curso)) {
      die("Error al registrar curso");
  }

// Abre una conexión a la base de datos
include "../database/conexion.php";

// Crea una consulta SQL para insertar el usuario en la tabla de usuarios
$query = "INSERT INTO cursos (nombre_curso)
          VALUES ('$nombre_curso')";

// Ejecuta la consulta y comprueba si se ha ejecutado correctamente
if (mysqli_query($conexion, $query)) {
  // Si se ha ejecutado correctamente, redirige al usuario a la página de inicio
  header('Location: ../cursos.php');
} else {
  // Si ha habido un error, muestra un mensaje de error
  echo 'Error: ' . mysqli_error($conexion);
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>