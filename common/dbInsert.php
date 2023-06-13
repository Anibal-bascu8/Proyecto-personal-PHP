<?php

require_once "bdatos.php";

require_once "dbselect.php";




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
