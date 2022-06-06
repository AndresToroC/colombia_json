<?php

$mysqli = new mysqli('localhost', 'root', '', 'laravel');
$mysqli->set_charset('utf8');

if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";

$objects = json_decode(file_get_contents('./colombia.json'));

// Inserta país
$sqlCountries = "INSERT INTO countries (name) VALUES ('Colombia')";

$mysqli->query($sqlCountries);
$country_id = mysqli_insert_id($mysqli);

foreach ($objects as $key => $object) {
    // if ($object->departamento == 'Bolívar') {
    //     var_dump($object->departamento);exit;
    // }
    // Ingresa el departamento
    $sqlDepartment = "INSERT INTO departments (name, country_id) VALUES ('$object->departamento', $country_id)";

    $mysqli->query($sqlDepartment);
    $department = mysqli_insert_id($mysqli);

    foreach ($object->ciudades as $key => $ciudad) {
        // Ingrese la ciudad
        $sqlCities = "INSERT INTO cities (name, department_id) VALUES ('$ciudad', $department)";
        $mysqli->query($sqlCities);
    }
}