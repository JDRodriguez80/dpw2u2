<?php
require "config/conexion.php";
$conn = new conexion();
$conexion = $conn->conectar();
session_start();
$id = $_GET['id'];
if (!isset($_SESSION['active'])) {
    header("location:../index.php");
}
if ($_SESSION['tipo'] == 1) {
    header("location:../index.php");
}
if (!empty($_POST)) {
   
   
    $query = $conexion->prepare("DELETE FROM PREINSCRIPCION WHERE TransId = '$id'");
    $querry_delete = $query->execute();
    if ($querry_delete) {
        header("location: consultarInscripcionControl.php");
    } else {
        echo "Error al eliminar";
    }
}
if ($id==null) {
    header("location: consultarInscripcionControl.php");
    $this->conexion = null;
} else {
    
    $query = $conexion->prepare("SELECT * FROM PREINSCRIPCION WHERE TransId = '$id'");
    $query->execute();
    if ($query->rowCount() > 0) {
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $matricula = $data['Matricula'];
        $asignatura = $data['Asignatura'];
        $grupo = $data['Grupo'];
        $profesor = $data['Profesor'];
        $semestre = $data['Semestre'];
    } else {
        header("location: consultarInscripcionControl.php");
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

    $ntipo = "";
    if ($tipo == 1) {
        $ntipo = "AL";
    } else if ($tipo == 2) {
        $ntipo = "SE";
    }
    ?>

    <H1>Bienvenido <?php echo $nombreCompleto; ?></H1>
    <h2>Has ingresado como: <?php echo $ntipo; ?></h2>
</body>
<h1>Eliminar Asignatura</h1>
<h3>Confirmar eliminacion de registro con los siguientes datos:</h3>
<h3>Matricula: <span><?php echo $matricula ?></span></h3>
<h3>Asignatura: <span><?php echo $asignatura ?></span></h3>
<h3>Grupo: <span><?php echo $grupo ?></span></h3>
<h3>Profesor: <span><?php echo $profesor ?></span></h3>
<h3>Semestre: <span><?php echo $semestre ?></span></h3>
<form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <a href="consultarInscripcionControl.php" class="btn_cancel">Cancelar</a>
    <input type="submit" value="Confirmar" class="btn_ok">
</form>

</html>