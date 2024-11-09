<?php
// Configuración de conexión a la base de datos
$servername = "localhost";  // Cambia esto por tu servidor de base de datos
$username = "root";         // Tu usuario de la base de datos
$password = "";             // Tu contraseña de la base de datos
$dbname = "wawawa"; // Cambia esto por el nombre de tu base de datos

// Inicializa el mensaje
$message = "";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $dieta = $_POST['txt_dieta'];
    $recomendaciones = $_POST['txt_recomendaciones'];

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO plan_salud (dieta, recomendaciones) VALUES (?, ?)";

    // Usar prepared statements para evitar inyecciones SQL
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $dieta, $recomendaciones);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $message = "Los datos se han guardado correctamente.";
        } else {
            $message = "Hubo un error al guardar los datos.";
        }

        // Cerrar el statement
        $stmt->close();
    } else {
        $message = "Error en la preparación de la consulta.";
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLAN SALUD</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8f0;
            color: #333;
        }
        .titulo {
            color: #556b2f;
            text-align: center;
            border: 2px solid #556b2f;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 20px;
        }
        .footer {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .footer img {
            width: 25%; 
            height: auto;
            border-radius: 10px 0 0 10px;
        }
        .footer .texto {
            flex: 1;
            padding: 20px;
            font-family: serif;
            border-radius: 0 10px 10px 0;
            background-color: rgba(255, 255, 255, 0.5);
        }
    </style>
    <script>
        function validarCaracteres(input) {
            const regex = /^[a-zA-Z\s]*$/; 
            if (!regex.test(input.value)) {
                alert("Por favor, introduce solo caracteres"); 
            }
        }
        function validarFormulario() {
            const dieta = document.getElementById('Dieta').value;
            const recomendaciones = document.getElementById('Recomendaciones').value;

            if (dieta === "" || recomendaciones === "") {
                alert("Por favor, completa todos los campos.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-5"> 
                <div class="titulo">Formulario de la salud</div>
                <?php if ($message): ?>
                    <div class="alert alert-info"><?php echo $message; ?></div>
                <?php endif; ?>
                <form action="" method="post" onsubmit="return validarFormulario()">
                    <div class="form-group">
                        <input type="text" class="form-control" id="Dieta" name="txt_dieta" placeholder="Dieta" onkeyup="validarCaracteres(this)" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Recomendaciones" name="txt_recomendaciones" placeholder="Recomendaciones" onkeyup="validarCaracteres(this)" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Enviar</button>
                </form>
            </div>
            <div class="col-md-5"> 
                <div class="video">
                    <iframe width="100%" height="315" src="" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-5 footer"> 
                <img src="imagenes/elbo.png" alt="ELBO" />
                <div class="texto">
                    ola jijos de sumaiz, ete es el apartado de plan de salud, escribe la recomendacion y dieta deseada ayi arribita :D porfiqsinomepegan D:
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
