<?php
require_once "conexion.php";

if (isset($_POST['regionId'])) {
    $regionId = $_POST['regionId'];

    // Consulta SQL para obtener las comunas según la región seleccionada
    $sql = "SELECT * FROM comunas WHERE region_id = $regionId";
    $result = $conn->query($sql);

    // Generar las opciones de los select de comunas
    $options = "<option value=''>Seleccionar Comuna</option>";
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
    }

    echo $options;
}
?>
