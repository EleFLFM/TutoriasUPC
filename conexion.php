<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "roles";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión y manejar errores
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
