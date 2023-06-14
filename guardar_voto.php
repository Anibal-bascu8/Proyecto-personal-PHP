<?php

require_once("common/dbSelect.php");

require_once("common/dbInsert.php");



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_REQUEST["nombre"];
    $alias = $_REQUEST["alias"];
    $rut = $_REQUEST["rut"];
    $email = $_REQUEST["email"];
    $region = $_REQUEST["region"];
    $comuna = $_REQUEST["comuna"];
    $candidato = $_REQUEST["candidato"];
    $entero = $_REQUEST["entero"];

    // Verificar duplicación de votos por RUT
    $validar = validarVoto($rut);


    $longitud = count($validar);

    if ($longitud == 0) {
        // no se encuentran registros previos, puede votar


        // Insertar el voto en la tabla votos
        insert_Voto($nombre, $alias, $rut, $email, $region, $comuna, $candidato, $entero);
        
        echo "<script>alert('Voto Ingresado Correctamente!');</script>";
        echo "<script>top.location.href='index.php';</script>";
    } else {
        // si se encuentran registros previos, NO puede votar

        echo "<script>alert('El rut ingresado ya ha votado previamente');</script>";
        echo "<script>top.location.href='index.php';</script>";
    }
}
