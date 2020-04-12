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
    <link rel="shortcut icon" href="/images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Aine</title>
  </head>
  <body>
    <?php require('nav-bar.php'); ?>
    <div class="links">
        <a href="statistika.php" class="lingid"> Statistika</a>
        <a href="aine.php" class="lingid" id="chosen">Aine</a>
        <a href="kalender.php" class="lingid">Kalender</a>
        <a href="seaded.php" class="lingid" id="tools"> Seaded</a>
    </div>
    <div id="inputContainer">
      <label for="class">Aine </label>

      <select id="class">
        <option value="C#">C#</option>
        <option value="java">java</option>
        <option value="python">python</option>
        <option value="interaktsioonidisain">interaktsiooni disainid</option>
      </select>
      <br />

      <label for="type">Tüüp </label>

      <select id="type">
        <option value="rühm">rühmatöö</option>
        <option value="iseseisev">iseseisev töö</option>
        <option value="kodune">kodune töö</option>
      </select>
      <br />

      <label for="kulu">Kulu </label>
      <input type="time" id="kulu" name="time" />
      <input type="button" value="sisesta" id="button" />
    </div>


  </body>
</html>
