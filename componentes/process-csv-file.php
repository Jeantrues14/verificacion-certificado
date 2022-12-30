<?php
function processCsvFile($file) {
    // Comprueba si se ha proporcionado un archivo CSV
    if (!isset($file) || empty($file)) {
      throw new Exception('No se ha proporcionado un archivo CSV válido');
    }
  
    // Abre el archivo CSV en modo lectura
    $csvFile = fopen($file, 'r');
  
    // Lee la primera línea del archivo CSV (que contiene los títulos de las columnas)
    $csvColumnTitles = fgetcsv($csvFile);
  
    // Verifica que el archivo CSV tenga las columnas necesarias (nombre, apellido, usuario, password, rol)
    if (count($csvColumnTitles) != 5) {
      throw new Exception('El archivo CSV debe tener cinco columnas: nombre, apellido, usuario, password, rol');
    }
  
    // Conecta a la base de datos
    $conn = mysqli_connect('localhost', 'root', '', 'ctf_acreditaciones');
  
    // Verifica que la conexión a la base de datos se haya establecido correctamente
    if (!$conn) {
      throw new Exception('Error al conectar a la base de datos: ' . mysqli_connect_error());
    }
  
    // Prepara la consulta de inserción de usuarios
    $insertQuery = "INSERT INTO usuarios (nombre, apellido, usuario, password, rol) VALUES (?, ?, ?, ?, ?)";
  
    // Prepares the insert statement
    $stmt = mysqli_prepare($conn, $insertQuery);
  
    // Binds the parameters to the insert statement
    mysqli_stmt_bind_param($stmt, 'sssss', $nombre, $apellido, $usuario, $password, $rol);
  
    // Reads each row of the CSV file and processes it
    while (($csvRow = fgetcsv($csvFile)) !== FALSE) {
      // Assigns the values of the row to the user to be inserted
      $nombre = $csvRow[0];
      $apellido = $csvRow[1];
      $usuario = $csvRow[2];
      $password = $csvRow[3];
      $rol = $csvRow[4];
  
      // Executes the insert query
      mysqli_stmt_execute($stmt);
    }
  
    // Cierra la conexión a la base de datos y el archivo CSV
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    fclose($csvFile);

    // Devuelve un mensaje de éxito
    return 'Los usuarios se han importado correctamente';
}
?>