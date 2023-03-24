<?php
require "config/conexion.php";
$conn = new conexion();
$conexion = $conn->conectar();
session_start();

$searchErr = "";
$ejecutar = '';
if (!isset($_SESSION['active'])) {
    header("location:../index.php");
}
if (isset($_POST['save'])) {
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $querry = $conexion->prepare("SELECT * FROM PREINSCRIPCION WHERE matricula = '$id'");
        $querry->setFetchMode(PDO::FETCH_ASSOC);
        $querry->execute();
        $ejecutar = $querry->fetchAll();
    } else {
        $searchErr = "Introduzca una matricula";
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

    <h1>Bienvenido <?php echo $nombreCompleto; ?></h1>
    <h2>Has ingresado como: <?php echo $ntipo; ?></h2>

    <form action="#" method="post">
        <label for="id">Introduzca la matricula del estudiante a consultar</label>
        <input type="text" name="id" id="id" placeholder="Matricula">
        <button type="submit" name="save">Buscar</button>
    </form>
    <br /><br />
    <h3><u>Resultado de la busqueda</u></h3><br />
    <table border="1">
        <tr>

            <th>Asignatura</th>
            <th>Grupo</th>
            <th>Profesor</th>
            <th>Turno</th>
            <th>Semestre</th>
            <th>Estatus</th>
            <th>Acciones</th>


        </tr>
        <br>

        <tbody>
            <?php
            if (!$ejecutar) {
                echo '<tr>No se encontraron materias</tr>';
            } else {
                foreach ($ejecutar as $row) {
            ?>
                    <tr>
                        <td><?php echo $row['Asignatura']; ?></td>
                        <td><?php echo $row['Grupo']; ?></td>
                        <td><?php echo $row['Profesor']; ?></td>
                        <td><?php echo $row['Turno']; ?></td>
                        <td><?php echo $row['Semestre']; ?></td>
                        <td><?php echo $row['Estatus']; ?></td>
                        <td>
                            <a href="editarAsignatura.php?id=<?php echo $row['TransId']; ?>">Editar</a>
                            <a href="eliminarAsignatura.php?id=<?php echo $row['TransId']; ?>">Eliminar</a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>


    </table>
</body>

</html>