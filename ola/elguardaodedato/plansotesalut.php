<?php
include 'conexion1.php'; // Asegúrate de que este archivo esté bien configurado

$message = ''; // Variable para almacenar mensajes

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dieta = $_POST['txt_dieta'] ?? ''; 
    $recomendaciones = $_POST['txt_recomendaciones'] ?? ''; 

    if ($dieta && $recomendaciones) {
        $sql = "INSERT INTO plan_salud (dieta, recomendaciones) VALUES (?, ?)";
        $stmt = $cn->prepare($sql);
        $stmt->bind_param("ss", $dieta, $recomendaciones);

        if ($stmt->execute()) {
            $message = "Nuevo plan de salud creado con éxito";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Por favor, completa todos los campos.";
    }
}
$cn->close();
?>