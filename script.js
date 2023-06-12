$(document).ready(function () {
  // Cargar regiones al cargar la página
  cargarRegiones();

  // Cargar comunas al seleccionar una región
  $("#region").change(function () {
    var regionId = $(this).val();
    cargarComunas(regionId);
  });

  // Cargar candidatos al cargar la página
  cargarCandidatos();

  // Validación y envío del formulario
  $("#votacionForm").submit(function (event) {
    event.preventDefault();
    if (validarFormulario()) {
      guardarVoto();
    }
  });

  // Función para cargar las regiones
  function cargarRegiones() {
    $.ajax({
      url: "cargar_regiones.php",
      type: "GET",
      success: function (response) {
        $("#region").html(response);
      }
    });
  }

  // Función para cargar las comunas según la región seleccionada
  function cargarComunas(regionId) {
    $.ajax({
      url: "cargar_comunas.php",
      type: "POST",
      data: { regionId: regionId },
      success: function (response) {
        $("#comuna").html(response);
      }
    });
  }

  // Función para cargar los candidatos
  function cargarCandidatos() {
    $.ajax({
      url: "cargar_candidatos.php",
      type: "GET",
      success: function (response) {
        $("#candidato").html(response);
      }
    });
  }

  // Función para validar el formulario
  function validarFormulario() {
    var nombre = $("#nombre").val().trim();
    var alias = $("#alias").val().trim();
    var rut = $("#rut").val().trim();
    var email = $("#email").val().trim();
    var region = $("#region").val();
    var comuna = $("#comuna").val();
    var candidato = $("#candidato").val();
    var checkboxes = $("input[name='entero[]']:checked");

    // Validar campos requeridos
    if (nombre === "" || alias === "" || rut === "" || email === "" || region === "" || comuna === "" || candidato === "") {
      alert("Todos los campos son requeridos.");
      return false;
    }

    // Validar alias
    if (alias.length < 5 || !/^[a-zA-Z0-9]+$/.test(alias)) {
      alert("El alias debe tener al menos 5 caracteres y contener solo letras y números.");
      return false;
    }

    // Validar RUT
    if (!validarRut(rut)) {
      alert("El RUT ingresado no es válido.");
      return false;
    }

    // Validar email
    if (!validarEmail(email)) {
      alert("El correo electrónico ingresado no es válido.");
      return false;
    }

    // Validar selección de al menos dos checkboxes
    if (checkboxes.length < 2) {
      alert("Debe seleccionar al menos dos opciones en '¿Cómo se enteró de nosotros?'");
      return false;
    }

    return true;
  }

  // Función para validar el formato de RUT chileno
  function validarRut($rut) {
    // Eliminar puntos y guión del RUT
    $rut = preg_replace('/[^k0-9]/i', '', $rut);

    // Verificar que el RUT no esté vacío
    if (empty($rut)) {
      return false;
    }

    // Verificar longitud mínima del RUT
    if (strlen($rut) < 3) {
      return false;
    }

    // Separar el RUT y el dígito verificador
    $rut = substr($rut, 0, -1);
    $dv = strtoupper(substr($rut, -1));

    // Verificar que el RUT sea numérico
    if (!is_numeric($rut)) {
      return false;
    }

    // Calcular el dígito verificador esperado
    $suma = 0;
    $multiplo = 2;

    for ($i = strlen($rut) - 1; $i >= 0; $i--) {
      $suma += $rut[$i] * $multiplo;
      $multiplo = ($multiplo == 7) ? 2 : $multiplo + 1;
    }

    $dv_esperado = 11 - ($suma % 11);
    $dv_esperado = ($dv_esperado == 11) ? 0 : (($dv_esperado == 10) ? 'K' : $dv_esperado);

    // Comparar el dígito verificador ingresado con el esperado
    if ($dv != $dv_esperado) {
      return false;
    }

    return true;
  }



  // Función para validar el formato de correo electrónico
  function validarEmail(email) {
    // Verificar que el email no esté vacío
    if (email.trim() === '') {
      return false;
    }
  
    // Verificar el formato del email utilizando una expresión regular
    var patron = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!patron.test(email)) {
      return false;
    }
  
    return true;
  }
  

  // Función para guardar el voto mediante Ajax
  function guardarVoto() {
    var formData = $("#votacionForm").serialize();

    $.ajax({
      url: "guardar_voto.php",
      type: "POST",
      data: formData,
      success: function (response) {
        alert("Voto registrado exitosamente.");
        $("#votacionForm")[0].reset();
      }
    });
  }
});
