<?php
session_start();
if (!isset($_SESSION['active'])) {
    header("location:../index.php");
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
    <?php include "includes/navLog.php";
    $nombreCompleto = $_SESSION['nombre'] . " " . $_SESSION['apellidoP'] . " " . $_SESSION['apellidoM'];
    $tipo = $_SESSION['tipo'];
    $ntipo = "";
    if ($tipo == 1) {
        $ntipo = "Estudiante";
    } else if ($tipo == 2) {
        $ntipo = "Profesor";
    }
    ?>

    <H1>Bienvenido <?php echo $nombreCompleto; ?></H1>
    <h2>Has ingresado como: <?php echo $ntipo; ?></h2>
</body>

</html>