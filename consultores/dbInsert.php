<?php

require_once "../common/bdatos.php";

require_once "./dbSelect.php";


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
    $validar = validarVoto($rut);
    
    if ($validar->num_rows > 0) {
        die("Ya has votado anteriormente.");
    }

    // Insertar el voto en la tabla votos
    insert_Voto($nombre, $alias,$rut,$email,$region,$comuna,$candidato,$entero );
}


function insert_Voto($nombre, $alias,$rut,$email,$region,$comuna,$candidato,$entero )
{

  global $sql, $arrResultado;

  
  $sql = "INSERT INTO votos (nombre, alias, rut, email, region, comuna, candidato, entero) ";
  
  $sql = $sql . "VALUES ('$nombre', '$alias', '$rut', '$email', '$region', '$comuna', '$candidato', '$entero')";
  //echo $sql;
  //die();

  $arrResultado = ejecutar($sql, "Insert");
  return $arrResultado;
}
?>
