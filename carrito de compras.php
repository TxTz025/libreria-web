<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Aquí va el código para mostrar y gestionar el carrito
?>
