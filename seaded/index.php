<?php
session_start();
include("../functions_subject.php");
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
        <a href="../statistika/" class="page"><span class="link_names">Statistika</span></a>
        <a href="../aine/" class="page"> <span class="link_names">Aine</span></a>
        <a href="../kalender/" class="page"><span class="link_names">Kalender</span></a>
        <a href="../seaded/" class="page" id="chosen"><span class="link_names">Seaded</span></a>
    </div>

    <div class="images">
    <img src="../images/statistics.png" alt="statistics" class="link_icons" id="first_icon">
    <img src="../images/add.png" alt="statistics" class="link_icons" id="second_icon">
    <img src="../images/calendar.png" alt="statistics" class="link_icons" id="third_icon">
    <img src="../images/wrench.png" alt="statistics" class="link_icons" id="fourth_icon">
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
            <div id="content_box">
                <?php
                   echo getPreviousActivities();
                ?>
            </div>
        </div>
    
  </body>
</html>