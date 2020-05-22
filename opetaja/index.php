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

</head>
<body>
<?php require('../nav-bar.php'); ?>
<div id="send_notifications">Saada teavitus</div>
</body>
</html>