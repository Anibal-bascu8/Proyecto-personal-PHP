<?php

require_once "bdatos.php";

require_once "dbselect.php";




function insert_Voto($nombre, $alias, $rut, $email, $region, $comuna, $candidato, $entero)
{

  global $sql, $arrResultado;


  $entero = ["TV", "amigo", "etc"];
  $cadena = implode(" | ", $entero);
  // echo $cadena; // Imprimirá "TV | amigo | etc"


  $sql = "INSERT INTO votos (nombre_apellido, alias, rut, email, region_id, comuna_id, candidato_id, entero) ";

  $sql = $sql . "VALUES ('$nombre', '$alias', '$rut', '$email', '$region', '$comuna', '$candidato', '$cadena')";
  // echo $sql;
  // die();

  $arrResultado = ejecutar($sql, "Insert");
  return $arrResultado;
}
