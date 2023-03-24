<?php
require "config/conexion.php";
$conn = new conexion();
$conexion = $conn->conectar();
session_start();
if (!isset($_SESSION['active'])) {
    header("location:../index.php");
}
if (!empty($_POST)) {
    if (empty($_POST['asignatura']) || empty($_POST['grupo']) || empty($_POST['profesor']) || empty($_POST['semestre'])) {
        echo 'Todos los campos son obligatorios';
    } else {
        $asignatura = $_POST['asignatura'];
        $grupo = $_POST['grupo'];
        $profesor = $_POST['profesor'];
        $semestre = $_POST['semestre'];
        $estatus = "Preinscrita";
        $turno = $_SESSION['turno'];
        $alumno = $_SESSION['id'];
        $matricula = $_SESSION['matricula'];
        $querry = $conexion->prepare("INSERT INTO PREINSCRIPCION(Asignatura, Grupo, Profesor, Semestre, Estatus, Turno,Id,Matricula) VALUES('$asignatura', '$grupo', '$profesor', '$semestre', '$estatus', '$turno', '$alumno', '$matricula')");
        $querry->execute();
        if ($querry) {
            echo "Preinscripción realizada correctamente";
        } else {
            echo "Error al realizar la preinscripción";
        }
    }
}
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
    <?php
    $tipo = $_SESSION['tipo'];
    if ($tipo == 1) {
        include "includes/navLog.php";
    } else if ($tipo == 2) {
        include "includes/navLogControl.php";
    }
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
    <h2>Preinscripción</h2>
    <br>
    <form action="preInscripcion.php" method="POST">
        <label for="asignatura">Asignatura</label>
        <input type="text" name="asignatura" id="asignatura" placeholder="Asignatura" required>
        <label for="grupo">Grupo</label>
        <input type="text" name="grupo" id="grupo" placeholder="Grupo" required>
        <label for="profesor">Profesor</label>
        <input type="text" name="profesor" id="profesor" placeholder="Profesor" required>
        <label for="semestre">Semestre</label>
        <input type="text" name="semestre" id="semestre" placeholder="Semestre" required>
        <input type="submit" value="Inscribirse">
    </form>

</body>

</html>