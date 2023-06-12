<?php
require_once "conexion.php";

// Consulta SQL para obtener las regiones
$sql = "SELECT * FROM regiones";
$result = $conn->query($sql);

// Generar las opciones de los select de regiones
$options = "<option value=''>Seleccionar Región</option>";
while ($row = $result->fetch_assoc()) {
    $options .= "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
}

echo $options;
?>
