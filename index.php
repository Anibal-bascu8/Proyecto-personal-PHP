<?php

require_once("common/constantes.php");
require_once("consultores/dbInsert.php");
require_once("consultores/dbSelect.php");


$arrayRegiones  = selectRegiones();
$totalRegiones  = count($arrayRegiones);


$arrayCandidatos  = selectCandidatos();
$totalCandidatos  = count($arrayCandidatos);


?>

<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Votación</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <!-- <script src="script.js"></script> -->
  <script>
    function buscarComunas(regionId) {
      $.ajax({
        url: 'cargar_comunas.php',
        method: 'POST',
        data: {
          regionId: regionId
        },
        success: function(response) {
          // Parsea la respuesta JSON recibida
          // return
          var comunas = JSON.parse(response);

          // Limpia y actualiza el select de comunas
          var selectComunas = document.getElementById('comuna');
          selectComunas.innerHTML = '';
          for (var i = 0; i < comunas.length; i++) {
            var option = document.createElement('option');

            option.value = comunas[i].id_comuna;
            option.text = comunas[i].name;
            selectComunas.appendChild(option);
          }
        },
        error: function(xhr, status, error) {
          console.error('Error en la solicitud AJAX:', error);
        }
      });

    }
  </script>

  <script>
    function onClickIngresar() {
      // alert("si llama el onclick");

      var valida = false;

      if (document.forms["votacionForm"].nombre.value == "") {
        valida = true;
      }
      if (document.forms["votacionForm"].alias.value == "") {
        valida = true;
      }
      if (document.forms["votacionForm"].rut.value == "") {
        valida = true;
      }
      if (document.forms["votacionForm"].email.value == "") {
        valida = true;
      }
      if (document.forms["votacionForm"].region.value == "") {
        valida = true;

      }
      if (document.forms["votacionForm"].comuna.value == "") {
        valida = true;
      }
      if (document.forms["votacionForm"].candidato.value == "") {
        valida = true;
      }


      if (valida) {
        alert('Debe ingresar datos obligatorios')
        return false;
      }


      document.forms["votacionForm"].method = "POST";
      document.forms["votacionForm"].action = "guardar_voto.php";
      // document.forms["votacionForm"].argAccion.value = 'grabar';
      document.forms["votacionForm"].submit();

    }
  </script>
</head>

<body>
  <div class="container mt-5">
    <h1 class="mb-4">FORMULARIO DE VOTACION</h1>
    <form id="votacionForm" name="votacionForm">
      <div class="form-group">
        <label for="nombre">Nombre y Apellido</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre y Apellido">
      </div>
      <div class="form-group">
        <label for="alias">Alias</label>
        <input type="text" class="form-control" id="alias" name="alias" placeholder="Alias">
      </div>
      <div class="form-group">
        <label for="rut">RUT</label>
        <input type="text" class="form-control" id="rut" name="rut" placeholder="RUT">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
      </div>
      <div class="form-group">
        <label for="region">Región</label>
        <select class="form-control" id="region" name="region" onchange="buscarComunas(this.value)">
          <option value="">Seleccionar Región</option>
          <?php

          $contador = 0;
          for ($j = 0; $j < $totalRegiones; $j++) {

            $contador++;

            $numeroRegion     = $arrayRegiones[$j][0];
            $nombreRegion  = $arrayRegiones[$j][1];

            echo '<option value="' . $numeroRegion . '"  ">' . $nombreRegion . '</option>';
          }

          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="comuna">Comuna</label>
        <select class="form-control" id="comuna" name="comuna">
          <option value="">Seleccionar Comuna</option>
        </select>
      </div>
      <div class="form-group">
        <label for="candidato">Candidato</label>
        <select class="form-control" id="candidato" name="candidato">
          <option value="">Seleccionar Candidato</option>
          <?php

          $contador = 0;
          for ($j = 0; $j < $totalCandidatos; $j++) {

            $contador++;

            $idCandidato      = $arrayCandidatos[$j][0];
            $nombreCandidato  = $arrayCandidatos[$j][1];

            echo '<option value="' . $idCandidato . '"  ">' . $nombreCandidato . '</option>';
          }

          ?>
        </select>
      </div>
      <div class="form-group">
        <label>¿Cómo se enteró de nosotros?</label><br>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="web" name="entero[]" value="web">
          <label class="form-check-label" for="web">Web</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="tv" name="entero[]" value="tv">
          <label class="form-check-label" for="tv">TV</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="redes" name="entero[]" value="redes">
          <label class="form-check-label" for="redes">Redes Sociales</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="amigo" name="entero[]" value="amigo">
          <label class="form-check-label" for="amigo">Amigo</label>
        </div>
      </div>
      <button class="btn btn-primary" onclick="onClickIngresar();">Enviar Voto</button>
    </form>
  </div>

</body>

</html>