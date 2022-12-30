<?php

// Conexión a la base de datos
include "../database/conexion.php";

// Obtener los valores del formulario
$id = $_POST['id'];
$nombre_curso = $_POST['nombre_curso'];

// Preparar la consulta
$query = "UPDATE cursos SET nombre_curso='$nombre_curso' WHERE id=$id";

// Ejecutar la consulta
if (mysqli_query($conexion, $query)) {
    echo "<script>
    document.getElementById('correcto').style.display = 'block';
    setTimeout(function() { location.reload();}, 1000);
    </script>";
    header("Location: ../cursos.php"); 
  } else {
      echo "<script>document.getElementById('error').style.display = 'block';</script>";
  }

// Cerrar la conexión
mysqli_close($conexion);

?>