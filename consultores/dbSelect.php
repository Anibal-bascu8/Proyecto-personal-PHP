<?php
require_once "../common/bdatos.php";


function selectCandidatos()
{
  global $sql, $arrResultado;

  $sql = "SELECT ";
  $sql = $sql . " *  ";
  $sql = $sql . " FROM candidatos  ";
  

//echo $sql;

  $arrResultado = ejecutar($sql, "Select");
  return $arrResultado;
}


function selectComunas()
{
  global $sql, $arrResultado;

  $sql = "SELECT ";
  $sql = $sql . " *  ";
  $sql = $sql . " FROM comunas  ";
  

//echo $sql;

  $arrResultado = ejecutar($sql, "Select");
  return $arrResultado;
}


function selectRegiones()
{
  global $sql, $arrResultado;

  $sql = "SELECT ";
  $sql = $sql . " *  ";
  $sql = $sql . " FROM regiones  ";
  

//echo $sql;

  $arrResultado = ejecutar($sql, "Select");
  return $arrResultado;
}

function validarVoto($rut)
{
  global $sql, $arrResultado;

  $sql = "SELECT ";
  $sql = $sql . " *  ";
  $sql = $sql . " FROM votos  ";
  
  $sql = $sql . " WHERE 1 = 1  ";
  
  $sql = $sql . " AND rut = ". $rut;
  

//echo $sql;

  $arrResultado = ejecutar($sql, "Select");
  return $arrResultado;
}

?>
