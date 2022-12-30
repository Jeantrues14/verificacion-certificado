<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
include "../database/conexion.php";

// Comprobamos si se ha subido un archivo CSV
if (isset($_FILES['csvFile']['name'])) {
  // Leemos el archivo CSV
  $file = fopen($_FILES['csvFile']['tmp_name'], "r");
  // Recorremos el archivo línea por línea
  $row = 1; // Inicializamos la variable que lleva el número de fila
  while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
    if ($row == 1) { // Si es la primera fila, la ignoramos
      $row++;
      continue;
    }
    // Insertamos los usuarios en la tabla
    $sql = "INSERT INTO usuarios (nombre, apellido, rol, usuario, password) VALUES (?, ?, ?, ' ', ' ')";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $data[0], $data[1], $data[2]);
    $result = mysqli_stmt_execute($stmt);
    if (!$result) {
      // Si hubo un error, mostramos el mensaje de error
        echo '<script type="text/javascript">';
        echo 'alert("Error al insertar el usuario: ' . mysqli_error($conexion) . '");';
        echo '</script>';
    }
  }
  fclose($file); // Cerramos el archivo
  // Si se insertaron usuarios, mostramos el mensaje de éxito
  if (mysqli_stmt_affected_rows($stmt) > 0) {
    header("Location: ../usuarios.php"); 
  }
}

// Cerramos la conexión a la base de datos
mysqli_close($conexion);

?>