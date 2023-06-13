<?php

require_once "bdatos.php";



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


function selectComunas($region)
{
  global $sql, $arrResultado;

  $sql = "SELECT ";
  $sql = $sql . " *  ";
  $sql = $sql . " FROM comunas  ";
  $sql = $sql . " WHERE id_region = " . $region;


  // echo $sql;
  // die();

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

  $sql = $sql . " AND rut = " . $rut;


  //echo $sql;

  $arrResultado = ejecutar($sql, "Select");

  
  echo $arrResultado;
  return $arrResultado;

  
}
