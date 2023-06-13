<?php

require_once("common/dbSelect.php");

if (isset($_REQUEST['regionId'])) {
    $region = $_REQUEST['regionId'];

    $arrayRegiones = selectComunas($region);

    // Devolver la respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($arrayRegiones);
} else {
    // Manejar el caso cuando no se proporciona regionId
    echo "No se proporcionó regionId";
}

?>
