<?php
require "config/conexion.php";
$conn = new conexion();
$conexion = $conn->conectar();
session_start();
if (isset($_SESSION['active'])) {
    header("location:main.php");
}

if (!empty($_POST)) {

    if (empty($_POST['matricula']) || empty($_POST['nombre']) || empty($_POST['apellidoP']) || empty($_POST['apellidoM']) || empty($_POST['contraseña'])) {
        echo 'Todos los campos son obligatorios';
    }
    $password = $_POST['contraseña'];
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        echo 'La contraseña debe tener al menos 8 caracteres y debe contener al menos un número, una letra mayúscula y un carácter especial.';
    } else {
        $matricula = $_POST['matricula'];
        $nombre = $_POST['nombre'];
        $apellidoP = $_POST['apellidoP'];
        $apellidoM = $_POST['apellidoM'];
        $contraseña = md5($_POST['contraseña']);
        $contraseña2 = md5($_POST['contraseña2']);
        $turno = $_POST['turno'];
        $rol = 1; //solo se pueden insertar usuarios de tipo 1
        $querry = $conexion->prepare("SELECT * FROM usuarios WHERE matricula = '$matricula'");
        $querry->execute();
        $result = $querry->rowCount();
        if ($result > 0) {
            echo "La matricula ya fue registrada	";
        } else {
            if ($contraseña != $contraseña2) {
                echo "Las contraseñas no coinciden";
            } else {
                $querry = $conexion->prepare("INSERT INTO usuarios(matricula, Nombre, ApellidoPaterno, ApellidoMaterno,Turno, TipoUsuario,  Password) VALUES('$matricula', '$nombre', '$apellidoP', '$apellidoM',$turno,'$rol','$contraseña')");
                $querry->execute();
                if ($query) {
                    echo "Usuario registrado correctamente";
                } else {
                    echo "Error al registrar el usuario";
                }
            }
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
    <title>Registro</title>
</head>

<body>
    <header>
        <?php include "includes/nav.php" ?>
    </header>
    <h1>Registro</h1>
    <br>
    <br>
    <form action="registro.php" method="POST">
        <label for="matricula">Matricula</label>
        <input type="text" name="matricula" id="matricula" placeholder="Matricula" required>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
        <label for="apellidoP">Apellido Paterno</label>
        <input type="text" name="apellidoP" id="apellidoP" placeholder="Apellido Paterno" required>
        <label for="apellidoM">Apellido Materno</label>
        <input type="text" name="apellidoM" id="apellidoM" placeholder="Apellido Materno" required>
        <label for="turno">Turno</label>
        <select name="turno" id="turno">
            <option value="1">Matutino</option>
            <option value="2">Vespertino</option>

        </select>
        <br>
        <br>
        <label for="password">Contraseña</label>
        <input type="password" name="contraseña" id="contraseña" placeholder="Contraseña" required>
        <label for="contraseña2">Confirmar contraseña</label>
        <input type="password" name="contraseña2" id="contraseña2" placeholder="Confirmar contraseña" required>
        <input type="submit" value="Registrar">

</body>

</html>