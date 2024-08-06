<?php
// conexion.php
$servername = "localhost";
$username = "usuario";
$password = "contraseña";
$dbname = "LIBRERIA";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
