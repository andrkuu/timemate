<?php

session_start();

/*
if(!isset($_SESSION["userFirstName"])){
    header("Location: index.php");
    exit();
}
kui ei ole sisselogitud siis see viskab login lehele tagasi. Hiljem lisa igale lehele

*/

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" href="../images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css">
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
        <i class="arrow left"></i>
        <select id="day">
        </select>
        <i class="arrow right"></i>
      <label for="class" id="label">Aine </label>

      <select id="class">
        <option value="C#">C#</option>
        <option value="java">java</option>
        <option value="python">python</option>
        <option value="interaktsioonidisain">interaktsiooni disainid</option>
      </select>
      <br />

      <label for="type" id="label">Tüüp </label>

      <select id="type">
        <option value="rühm">rühmatöö</option>
        <option value="iseseisev">iseseisev töö</option>
        <option value="kodune">kodune töö</option>
      </select>
      <br />

      <label for="kulu" id="label">Kulu </label>
      <input type="time" id="kulu" name="time" />
      <input type="button" value="sisesta" id="button" />
    </div>


  </body>
</html>
