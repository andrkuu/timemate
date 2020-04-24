<?php

session_start();
include("../functions_subject.php");
/*
if(!isset($_SESSION["userFirstName"])){
    header("Location: index.php");
    exit();
}
kui ei ole sisselogitud siis see viskab login lehele tagasi. Hiljem lisa igale lehele

*/
$today = ("täna");
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" href="../images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="subject.css">
    <title>Aine</title>
  </head>
  <body>
    <?php require('../nav-bar.php'); ?>
    <div class="links">
        <a href="../statistika/" class="page"> Statistika</a>
        <a href="../aine/" class="page" id="chosen">Aine</a>
        <a href="../kalender/" class="page">Kalender</a>
        <a href="../seaded/" class="page" id="tools"> Seaded</a>
    </div>
    <div id="inputContainer">
        <div id="arrows">
            <i class="arrow left"></i>
            <?php echo $today; ?>
            <i class="arrow right"></i>
        </div>

      <label for="class" id="label">Aine </label>

        <?php
            echo getSubjects();
        ?>
      <br />

      <label for="type" id="label">Tüüp </label>

        <?php
            echo getActivities();
        ?>
      <br />

      <label for="kulu" id="label">Kulu </label>
      <input type="time" id="kulu" name="time" />
      <input type="button" value="sisesta" id="button" />
    </div>


  </body>
</html>
