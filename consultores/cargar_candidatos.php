<?php
require_once "conexion.php";

// Consulta SQL para obtener los candidatos
$sql = "SELECT * FROM candidatos";
$result = $conn->query($sql);

// Generar las opciones de los select de candidatos
$options = "<option value=''>Seleccionar Candidato</option>";
while ($row = $result->fetch_assoc()) {
    $options .= "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
}

echo $options;
?>
