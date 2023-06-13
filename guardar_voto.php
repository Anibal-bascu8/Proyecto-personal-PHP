<?

require_once("common/dbSelect.php");

require_once("common/dbInsert.php");



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




    // Insertar el voto en la tabla votos
    insert_Voto($nombre, $alias, $rut, $email, $region, $comuna, $candidato, $entero);
}
