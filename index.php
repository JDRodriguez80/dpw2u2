<?php
require_once "config/conexion.php";
$conn = new conexion();
$conexion = $conn->conectar();
session_start();
if (isset($_SESSION['active'])) {
    header("location:views/main.php");
}
?>
<!DOCTYPE html>
<html lang="es-mx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Css/estilo.css">
    <title>Document</title>
</head>

<body>
    <header>
        <?php include "includes/nav.php" ?>
    </header>
    <h1>Usted no esta logeado</h1>
</body>

</html>