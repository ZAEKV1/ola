<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "wawawa";
    
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    
    $consulta_id = intval($_POST['consulta']); 

    
    if ($consulta_id > 99) {
        echo "El ID debe ser un número entre 1 y 99.";
    } else {
       
        $sql = "SELECT * FROM plan_salud WHERE clavep_plan_salud = $consulta_id";
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            
            $row = $result->fetch_array(MYSQLI_ASSOC);
            echo "<h3>Datos del Plan de Salud con ID: " . $row['clavep_plan_salud'] . "</h3>";
            echo "<p><strong>ID:</strong> " . $row['clavep_plan_salud'] . "</p>";
            echo "<p><strong>Dieta:</strong> " . $row['dieta'] . "</p>";
            echo "<p><strong>Recomendaciones:</strong> " . $row['recomendaciones'] . "</p>";
        } else {
            echo "No se encontró un registro con ese ID.";
        }
    }

        
    $conn->close();
}
?>

