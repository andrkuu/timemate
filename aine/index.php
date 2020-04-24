<?php

session_start();
include("../functions_subject.php");


/*if(!isset($_SESSION["userFirstName"])){
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
        <a href="../statistika/" class="page"><span class="link_names">Statistika</span></a>
        <a href="../aine/" class="page" id="chosen"> <span class="link_names">Aine</span></a>
        <a href="../kalender/" class="page"><span class="link_names">Kalender</span></a>
        <a href="../seaded/" class="page"><span class="link_names">Seaded</span></a>
    </div>

    <div class="images">
        <img src="../images/statistics.png" alt="statistics" class="link_icons" id="first_icon">
        <img src="../images/add.png" alt="statistics" class="link_icons" id="second_icon">
        <img src="../images/calendar.png" alt="statistics" class="link_icons" id="third_icon">
        <img src="../images/wrench.png" alt="statistics" class="link_icons" id="fourth_icon">
    </div>
    <div id="inputContainer">
        <div id="arrows">
            <i class="arrow left" onclick="changeDay(event)"></i>
            <p id="displayDay"></p>
            <i class="arrow right" onclick="changeDay(event)"></i>
        </div>

      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

          <p id="labelForSubjects"><label for="class" id="label">Aine </label></p>
        <div id="subject">
            <?php
                echo getSubjects();
            ?>
        </div>
      <br />

          <p id="labelForSubjects"><label for="type" id="label">Tüüp </label></p>

        <?php
           echo getActivities();
        ?>
      <br />

          <p id="labelForSubjects"><label for="kulu" id="label">Kulu </label></p>
      <input type="time" id="kulu" name="time" />
      <input id="submit_button" name="submitSubject" type="submit" value="sisesta" />

      </form>
    </div>


  </body>


</html>
<script>
    let days = ['täna', 'eile', 'üleeile'];
    let dayNr = 0;


    function changeDay(e) {
        if (e.target.className === "dayBefore") {
            if (dayNr !== 2)
                Document.getElementById("displayDay").innerHTML(days[dayNr + 1]);
        } else{
            if (dayNr !== 0)
                Document.getElementById("displayDay").innerHTML(days[dayNr - 1]);
        }
</script>