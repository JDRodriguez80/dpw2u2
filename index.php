<?php
require_once "config/conexion.php";
$conn = new conexion();
$conexion = $conn->conectar();
session_start();
if (isset($_SESSION['active'])) {
    header("location:main.php");
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
    <div class="container">
        <div class="Titulo">
            <h1>Preparatoria Municipal No. 1</h1>
        </div>
        <div class="Foto"><img src="/img/images.jpg" alt=""></div>
        <div class="parrafo">
            <p>Escuela Preparatoria dediacada a formar lideres pero primero buenos mexicanos</p>
        </div>

    </div>
</body>

</html>