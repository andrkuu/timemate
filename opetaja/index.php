<?php

session_start();
include("../functions_subject.php");

if(!isset($_SESSION["id"])){
    header("Location: ../");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ee">
<head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" href="../images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="teacher.css">
    <title>Ülevaade</title>
    <?php require('../nav-bar.php'); ?>

</head>
<body>

<div class="dropdown">
    <button class="dropbtn">Vali aine</button>
    <div class="dropdown-content">
        <a href="#">Matemaatika</a>
        <a href="#">Eesti Keel</a>
        <a href="#">Keemia</a>
    </div>
</div>

<form>
    <input type="text" id="mheader" name="mheader" placeholder="Pealkiri">
    <textarea placeholder="Sõnumi sisu"></textarea><br>
    <input type="submit" value="Saada ära">
</form>

<div id="send_notifications">Saada teavitus</div>
</body>
</html>