<?php

// Incluimos el archivo de conexión a la base de datos
include "../database/conexion.php";

// Verificamos si se ha pasado el ID del usuario a eliminar a través del parámetro GET
if (isset($_GET['id'])) {
  // Si se ha pasado el ID, lo guardamos en una variable
  $id = $_GET['id'];

  $query = "DELETE FROM certificados WHERE id = '$id'";

  if (mysqli_query($conexion, $query)) {
    echo "<script>
    setTimeout(function() { location.reload();}, 1000);
    </script>";
    header("Location: ../certificados.php"); 
  } else {
      echo "Error: " . $query . "<br>" . mysqli_error($conexion);
  }
}

// Cerrar la conexión
mysqli_close($conexion);


?>