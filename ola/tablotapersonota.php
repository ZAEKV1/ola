<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];
    $clavep_test = $_POST['clavep_test'];

    $sql = "INSERT INTO persona (nombre, apellido_paterno, apellido_materno, edad, sexo, clavep_test) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $cn->prepare($sql);
    $stmt->bind_param("sssiis", $nombre, $apellido_paterno, $apellido_materno, $edad, $sexo, $clavep_test);

    if ($stmt->execute()) {
        echo "Nueva persona creada con éxito";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$cn->close();
?>
