<?php
require "config/conexion.php";
$conn = new conexion();
$conexion = $conn->conectar();
session_start();
if (!isset($_SESSION['active'])) {
    header("location:../index.php");
}
$id = $_SESSION['id'];
$querry = $conexion->prepare("SELECT * FROM PREINSCRIPCION WHERE Id = '$id'");
$querry->setFetchMode(PDO::FETCH_ASSOC);
$querry->execute();
$ejecutar = $querry->fetchAll();
?>

<!DOCTYPE html>
<html lang="es-mx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Css/estilo.css">
    <title>Prepa Municipal</title>
</head>

<body>
    <?php include "includes/navLog.php";
    $nombreCompleto = $_SESSION['nombre'] . " " . $_SESSION['apellidoP'] . " " . $_SESSION['apellidoM'];
    $tipo = $_SESSION['tipo'];
    $ntipo = "";
    if ($tipo == 1) {
        $ntipo = "AL";
    } else if ($tipo == 2) {
        $ntipo = "SE";
    }
    ?>
    <h1>Bienvenido <?php echo $nombreCompleto; ?></h1>
    <h2>Has ingresado como: <?php echo $ntipo; ?></h2>
    <br>
    <h2>Estatus de inscripcion</h2>
    <br>
    <table border="1">
        <tr>
            <th>Asignatura</th>
            <th>Grupo</th>
            <th>Profesor</th>
            <th>Semestre</th>
            <th>Estatus</th>
            <th>Turno</th>
        </tr>
        <br>
        <?php foreach ($ejecutar as $row) : ?>

            <tr>
                <td><?php echo $row['Asignatura']; ?></td>
                <td><?php echo $row['Grupo']; ?></td>
                <td><?php echo $row['Profesor']; ?></td>
                <td><?php echo $row['Semestre']; ?></td>
                <td><?php echo $row['Estatus']; ?></td>
                <td><?php echo $row['Turno']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>

</body>

</html>