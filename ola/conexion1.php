<?php
$cn = new mysqli("localhost", "root", "", "wawawa");

//eta wea apoya por si hay fallos :D o verifica la conexion pues ...
if ($cn->connect_error) {
    die("Conexión fallida: " . $cn->connect_error);
}
?>
