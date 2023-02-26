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
    <?php include "includes/navLog.php" ?>
    <H1>Usuario valido</H1>
</body>

</html>