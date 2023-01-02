<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['logged_in'])) {
    // Redirige al usuario a la página protegida
    header("Location: panel.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/logoap.png">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/functions.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Iniciar Sesión | Acreditaciones Profesionales</title>
</head>
<body>
    <div class="menu">
        <a href="/" id="login"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z"/></svg> Inicio</a>
    </div>
    <div class="container">  
        <div class="login">
            <h1>Acceder</h1><br>
            <div class="alert alert-danger" id="error" role="alert">
              Error de usuario o contraseña, intenta nuevamente.
            </div>
            <div class="alert alert-success" id="correcto" role="alert">
              Accediste correctamente, redirigiendo...
            </div>
            <div class="alert alert-warning" id="error-rol" role="alert">
              Solo usuarios con rol de administrador pueden acceder.
            </div>     
            <form name="login-form" method="post" action="login.php">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Usuario</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" id="usuario" name="usuario">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" id="password" name="password">
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Recordarme</label>
                </div>
                <button type="submit" class="btn btn-primary btn-login">Ingresar</button>
              </form>
        </div>
        <div class="copy">
            <p> Copyright© 2022 Acreditaciones Profesionales | Todos los derechos reservados</p>
        </div>            
    </div>
    <!--Script Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['logged_in'])) {
    // Redirige al usuario a la página protegida
    header("Location: panel.php");
    exit;
}

// Incluye el archivo de configuración
include "database/conexion.php";

// Verifica si se ha enviado el formulario
if (isset($_POST['usuario']) && isset($_POST['password'])) {
    // Obtiene las credenciales del usuario del formulario
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Consulta la base de datos para verificar las credenciales del usuario
    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$password'";
    $result = mysqli_query($conexion, $query);

    // Verifica si el usuario existe en la base de datos y establece la variable de sesión
    if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          if ($row['rol'] == 'administrador') {
              // Inicia sesión y redirige al panel de administrador
              session_start();
              $_SESSION['logged_in'] = true;        
              echo "<script>
              document.getElementById('correcto').style.display = 'block';
              setTimeout(function() { location.reload();}, 1000);
              </script>";
              header("Location: panel.php");
              exit;
          } else {
              // Muestra un mensaje de error si el usuario no es administrador
              echo "<script>document.getElementById('error-rol').style.display = 'block';</script>";
          }        
        
    } else {
        // Muestra un mensaje de error
        echo "<script>document.getElementById('error').style.display = 'block';</script>";
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
  }
?>