<?php 
    require "config/conexion.php";
    $conn = new conexion();
    $conexion = $conn->conectar();
    session_start();
    $id=$_GET['id'];
    if (!isset($_SESSION['active'])) {
        header("location:../index.php");
    }
    if($_SESSION['tipo'] == 1){
        header("location:../index.php");
    }
    if(!empty ($_POST)){
        $matricula = $_POST['matricula'];
        $asignatura = $_POST['asignatura'];
        $grupo = $_POST['grupo'];
        $profesor = $_POST['profesor'];
        $semestre = $_POST['semestre'];
        $estatus = $_POST['estatus'];
        $query = "UPDATE PREINSCRIPCION SET Matricula = '$matricula', Asignatura = '$asignatura', Grupo = '$grupo', Profesor = '$profesor', Semestre = '$semestre', Estatus = '$estatus' WHERE TransId = '$id'";
        $resultado = $conexion->prepare($query);
        $resultado->execute();
        header("location: consultarInscripcionControl.php");
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
    }else if ($tipo == 2) {
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
    <form action="#" method="post">
        <!-- consultar base -->
        <?php 
         $querry=$conexion->prepare("SELECT * FROM PREINSCRIPCION WHERE TransId = '$id'");
         $querry->setFetchMode(PDO::FETCH_ASSOC);
         $querry->execute();
        ?>
        <?php foreach($querry as $row): ?>
        <label for="matricula">Matricula</label>
        <input type="text" name="matricula" id="matricula" value="<?php echo $row['Matricula'] ?>" required>
        <label for="asignatura">Asignatura</label>
        <input type="text" name="asignatura" id="asignatura" value="<?php echo $row['Asignatura'] ?>" required>
        <label for="grupo">Grupo</label>
        <input type="text" name="grupo" id="grupo" value="<?php echo $row['Grupo'] ?>" required>
        <label for="profesor">Profesor</label>
        <input type="text" name="profesor" id="profesor" value="<?php echo $row['Profesor'] ?>" required>
        <label for="semestre">Semestre</label>
        <input type="text" name="semestre" id="semestre" value="<?php echo $row['Semestre'] ?>" required>
        <label for="estatus">Estatus</label>
        <select name="estatus" id="estatus">
            <option value="Preinscrita">Preinscrita</option>
            <option value="Inscrita">Inscrita</option>
            <option value="Cancelada">Cancelada</option>
        </select>
        <?php endforeach; ?>
        <input type="submit" value="Actualizar">

    </form>

</html>