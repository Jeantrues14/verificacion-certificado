<?php
// Incluimos la conexión a la base de datos
include "../database/conexion.php";

// Verificamos que se hayan enviado los datos por el formulario
if (isset($_POST['id']) && isset($_POST['usuario_id']) && isset($_POST['curso_id'])) {
  // Recibimos los datos del formulario
  $id = $_POST['id'];
  $usuario_id = $_POST['usuario_id'];
  $curso_id = $_POST['curso_id'];

  // Armamos la consulta de actualización
  $query = "UPDATE certificados SET id_usuario = '$usuario_id', id_curso = '$curso_id' WHERE id = '$id'";

  // Ejecutamos la consulta
  if (mysqli_query($conexion, $query)) {
    // Si se actualizó correctamente, redirigimos al usuario a la página de certificados
    header("Location: ../certificados.php");
  } else {
    // Si hubo un error, mostramos un mensaje
    echo "Error al modificar el certificado: " . mysqli_error($conexion);
  }
}

?>