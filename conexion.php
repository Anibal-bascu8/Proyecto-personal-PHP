<?php
$servername = "localhost"; 
$username = "anibal"; 
$password = "tFNKBHoIb3meI12X"; 
$dbname = "db_anibal_localhost"; 

// Establecer conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
?>
