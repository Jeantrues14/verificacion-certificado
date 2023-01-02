<?php
  // Establecemos la conexión con la base de datos
  include "../database/conexion.php";

  // Recogemos la información del formulario
  $id = $_POST['id'];
  $usuario_id = $_POST['usuario_id'];
  $curso_id = $_POST['curso_id'];
  $emision = date("Y-m-d", strtotime($_POST['emision']));

  // Creamos la consulta para insertar el nuevo certificado en la base de datos
  $query = "INSERT INTO certificados (id, id_usuario, id_curso, emision) VALUES ('$id','$usuario_id', '$curso_id', '$emision')";

  // Ejecuta la consulta y comprueba si se ha ejecutado correctamente
if (mysqli_query($conexion, $query)) {
    // Si se ha ejecutado correctamente, redirige al usuario a la página de inicio
    header('Location: ../certificados.php');
  } else {
    // Si ha habido un error, muestra un mensaje de error
    echo "Error: " . $query . "<br>" . mysqli_error($conexion);
  }
  
  // Cierra la conexión a la base de datos
  mysqli_close($conexion);
  ?>