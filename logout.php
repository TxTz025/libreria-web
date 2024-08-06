<?php
session_start();
session_destroy(); // Destruye la sesión
header("Location: login.php"); // Redirige al formulario de inicio de sesión
exit();
?>
