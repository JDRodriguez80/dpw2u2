<?php
require "config/conexion.php";
$conn = new conexion();
$conexion = $conn->conectar();
session_start();
if (isset($_SESSION['active'])) {
    header("location:views/main.php");
}

if (filter_has_var(INPUT_POST, "usuario")) {
    $usuario_un = $_POST['usuario'];
    $usuario = htmlspecialchars($usuario_un);
    $pass_un = $_POST['pass'];
    $pass = htmlspecialchars($pass_un);

    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE matricula=:usuario AND Password=:pass");
    $stmt->bindParam(":usuario", $usuario);
    $stmt->bindParam(":pass", $pass);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($resultado) {
        $_SESSION['active'] = true;
        $_SESSION['usuario'] = $resultado['usuario'];
        $_SESSION['id'] = $resultado['id'];
        header("location:main.php");
    } else {
        echo "Usuario o contraseña incorrectos";
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
    <title>Document</title>
</head>

<body>
    <header>
        <?php include "includes/nav.php" ?>
    </header>
    <section class="inicio">
        <h1>Inicia sesion</h1>
        <form method="POST">
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="usuario">
            <label for="pass">Contraseña</label>
            <input type="password" name="pass" id="pass">
            <input type="submit" value="Iniciar sesión">
        </form>
    </section>

</body>

</html>