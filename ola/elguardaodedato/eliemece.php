<?php
include 'bd.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $altura = $_POST['altura'];
    $peso = $_POST['peso']; 
    $clavep_p_persona = $_POST['clavep_p_persona']; 

    
    if ($altura > 0 && $peso > 0) {
        $imc = $peso / (($altura / 100) * ($altura / 100)); 

        
        $stmt = $cn->prepare("INSERT INTO iemece (altura, peso, imc, clavep_p_persona) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("dddi", $altura, $peso, $imc, $clavep_p_persona);

       
        if ($stmt->execute()) {
            echo "Datos insertados correctamente en la tabla iemece.";
        } else {
            echo "Error al insertar datos: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "La altura y el peso deben ser valores positivos.";
    }
}

$cn->close(); 
?>
