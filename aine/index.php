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

if(isset($_POST["submitSubject"])){

    echo $_POST["subject"];
    echo "\n";
    echo $_POST["type"];
    echo "\n";
    echo $_POST["time"];
    $time = $_POST["time"];

    $arr = explode(':',$time);
    $hour = intval($arr[0]);
    $min = intval($arr[1]);

    $duration = ($hour * 60) + $min;

    echo(insert_time_report($_POST["subject"], $_POST["type"], $duration));
}

$today = ("täna");
?>
<script>

    let days = ['täna','eile','üleeile'];
    let dayNr = 0;


        function changeDay(e) {
            if (e.target.className === "arrow left")
                document.getElementById("displayDay").innerHTML(days[dayNr + 1]);

        }


</script>

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
            <i class="arrow left" id="dayBefore" onclick="smallerDayEst()"></i>
            <p id="displayDay"></p>
            <i class="arrow right" id="dayAfter" onclick="smallerDayEst()"></i>
        </div>

      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

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
      <input id="kulu" name="submitSubject" type="submit" value="sisesta" />

      </form>
    </div>


  </body>
</html>
