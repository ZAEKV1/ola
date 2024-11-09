<?php
include 'conexion1.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $puntaje = $_POST['puntaje'];
    $clavep_plan_salud = $_POST['clavep_plan_salud'];

    $sql = "INSERT INTO test (puntaje, clavep_plan_salud) VALUES (?, ?)";
    $stmt = $cn->prepare($sql);
    $stmt->bind_param("ii", $puntaje, $clavep_plan_salud);

    if ($stmt->execute()) {
        echo "Nuevo test creado con éxito";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$cn->close();
?>
