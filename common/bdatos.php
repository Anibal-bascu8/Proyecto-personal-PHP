<?php require_once( "constantes.php" );

/**************************************************************************
   Funciones Standares De Bdatos
 **************************************************************************/

//dbConectarse($constBDServidor, $constBDNombre, $constBDUsuario, $constBDPassword);

// Se conecta a la bdatos
//uso constantes de conexion definidas en archivo de constantes.php
/*function dbConectarse($Servidor, $Bdatos, $Usuario, $Password)
{

  //$resultado = @mysql_connect($Servidor, $Usuario, $Password);
  $obj_conexion = mysqli_connect($Servidor, $Usuario, $Password, $Bdatos);

  if (!$obj_conexion)
    return false;

  return $obj_conexion;

}*/


/* ejecuta una query sobre la bdatos
  Parametros:
*/
function ejecutar($query, $tipoQuery)
{
  $consEstaDebug = False; //True;
  //$consEstaDebug = True;
  //solo si esta en modo debug
  if ($consEstaDebug)
  {
    echo "<br><B> La query es: <BR>" . $query . "</B><BR>";
  }

  $arreglo = array();

  $constBDServidor = "localhost";
  $constBDNombre   = "cen74533_bysal_bd";
  $constBDUsuario  = "cen74533_bysal_user";
  $constBDPassword = "MySql2021";
  //Se abre la conexión
  $obj_conexion = mysqli_connect($constBDServidor, $constBDUsuario, $constBDPassword, $constBDNombre);

  //se ejecuta la query finalmente
  //$resultado = mysqli_query($succes, $query);
  $resultado = $obj_conexion->query($query);

  //si hubo error, mando a mostrarlo
  if (!$resultado) db_error($query);

  if ($tipoQuery=="Select")
    {
      while( $fila = $resultado->fetch_array())
      {
        $arreglo[] = $fila;
      }

      //borrar luego
      //echo "<br>resultado por ARREGLO -->". $resultado . "<--";
      return $arreglo;
    }

  if ($tipoQuery=="Valor")
  {
    //borrar luego
    //echo "<br>1.resultado -->". intVal($resultado) . "<--";
    //echo "<br>2.resultado -->". mysql_result($resultado,0,0);
    list($resul) = mysql_fetch_row($resultado);

    //echo "<br>EJECUTAR por VALOR-->". $resul;

    return $resul;
  }

  if ($tipoQuery=="Insert")
  {
    //borrar luego
    //echo "<br>resultado -->". $resultado . "<--";
    return $resultado;
  }


  if ($tipoQuery=="Delete")
  {
    //borrar luego
    //echo "<br>resultado -->". $resultado . "<--";
    return $resultado;
  }

  if ($tipoQuery=="Update")
  {
    //borrar luego
    //echo "<br>resultado -->". $resultado . "<--";
    return $resultado;
  }
}

//funcion exclusiva para logear en el sistema, anti sql injection
function ejecutarEspecial($query, $data, $variable){
	
	  $constBDServidor = "localhost";
	  $constBDNombre   = "cen74533_bysal_bd";
	  $constBDUsuario  = "cen74533_bysal_user";
	  $constBDPassword = "MySql2021";
	  //Se abre la conexión
	  
	  $conneccion = new PDO("mysql:host=". $constBDServidor.";dbname=".$constBDNombre, $constBDUsuario, $constBDPassword);
	  

	  $ejecutarQuery = $conneccion->prepare($query);
	  $ejecutarQuery->bindParam($variable, $data, PDO::PARAM_STR);
	  $ejecutarQuery->execute();
	  
	  $resultado = $ejecutarQuery->fetch(PDO::FETCH_ASSOC);
	  
	  return $resultado;

}

// Muestra un mensaje de error si la query falla.
function db_error($query)
{
  global $mensajeError;

  $the_error = "\n".mysqli_connect_error()."\n";

  $mensajeError = "<center><br><h3>Atencion!! <br> Hubo un error mientras se ejecutaba la sentencia </h3>"
              ."<textarea rows='8' cols='60'>"
              .htmlspecialchars($query)
              ."\n\n\n El error fue el siguiente:"
              .$the_error
              ."</textarea></center>";

  echo $mensajeError;
}

// Se DESCONECTA a la bdatos
function dbSalir()
{
  mysql_close();
}


?>

