<?php
// Inicia una sesión
session_start();

// Elimina la sesión actual y las variables de sesión
session_destroy();
session_unset();

// Redirige al usuario a la página de inicio de sesión
header("Location: ../login.php");
exit;
?>