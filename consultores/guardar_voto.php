<?php
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $alias = $_POST["alias"];
    $rut = $_POST["rut"];
    $email = $_POST["email"];
    $region = $_POST["region"];
    $comuna = $_POST["comuna"];
    $candidato = $_POST["candidato"];
    $entero = $_POST["entero"];

    // Verificar duplicación de votos por RUT
    $sql = "SELECT * FROM votos WHERE rut = '$rut'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        die("Ya has votado anteriormente.");
    }

    // Insertar el voto en la tabla votos
    $sql = "INSERT INTO votos (nombre, alias, rut, email, region, comuna, candidato, entero) VALUES ('$nombre', '$alias', '$rut', '$email', '$region', '$comuna', '$candidato', '$entero')";
    if ($conn->query($sql) === TRUE) {
        echo "Voto registrado exitosamente.";
    } else {
        echo "Error al registrar el voto: " . $conn->error;
    }
}

$conn->close();
?>
