<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" href="/images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Seaded</title>
  </head>
  <body>
    <?php include('nav-bar.php'); ?>
    <div class="links">
        <a href="statistics.php" class="page"> Statistika</a>
        <a href="subject.php" class="page" >Aine</a>
        <a href="calendar.php" class="page">Kalender</a>
        <a href="settings.php" class="page" id="chosen"> Seaded</a>

    </div>
    
  </body>
</html>