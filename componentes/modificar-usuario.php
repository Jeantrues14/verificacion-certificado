<?php

// Conexión a la base de datos
include "../database/conexion.php";

// Obtener los valores del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$rol = $_POST['rol'];

// Preparar la consulta
$query = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', rol='$rol' WHERE id=$id";

// Ejecutar la consulta
if (mysqli_query($conexion, $query)) {
    echo "<script>
    document.getElementById('correcto').style.display = 'block';
    setTimeout(function() { location.reload();}, 1000);
    </script>";
    header("Location: ../usuarios.php"); 
  } else {
      echo "<script>document.getElementById('error').style.display = 'block';</script>";
  }

// Cerrar la conexión
mysqli_close($conexion);

?>