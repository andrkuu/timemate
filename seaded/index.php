<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" href="../images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css">
      <link rel="stylesheet" href="tools.css">
    <title>Seaded</title>
  </head>
  <body>
    <?php include('../nav-bar.php'); ?>
    <div class="links">
        <a href="../statistika/" class="page"> Statistika</a>
        <a href="../aine/" class="page" >Aine</a>
        <a href="../kalender/" class="page">Kalender</a>
        <a href="../seaded/" class="page" id="chosen"> Seaded</a>

    </div>



        <div id="notifications">

           <div id="first" class="switch_box">
            <label class="switch" >
                <input type="checkbox">
                <span class="slider round"></span>
            </label>
               <span>Õppejõu teavitused</span>
           </div>

            <div id="second" class="switch_box">
            <label class="switch" >
                <input type="checkbox" id="second2" >
                <span class="slider round"></span>
            </label>
                <span>Tunniplaani teavitused</span>
            </div>

            <div  id="third" class="switch_box">
            <label class="switch">
                <input type="checkbox">
                <span class="slider round"></span>
            </label>
                <span>Tähtaja teavitused</span>
            </div>

        </div>

        <div id="history">
            <div id="history_header">Sinu eelmised tegevused</div>
            <div id="content_box"></div>
        </div>
    
  </body>
</html>