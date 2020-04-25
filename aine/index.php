<?php

session_start();
include("../functions_subject.php");



if(!isset($_SESSION["id"])){
    header("Location: ../");
    exit();
}



if(isset($_POST["submitSubject"])){

    /*echo $_POST["subject"];
    echo "\n";
    echo $_POST["type"];
    echo "\n";
    echo $_POST["time"];*/
    $min = $_POST["minuteSelect"];
    $hour = $_POST["hourSelect"];

   // echo $time;
    //echo "hour: ".$hour;
    //echo "minute: ".$min;
    //echo "<br>";
    $hour = intval(substr($hour,0,strlen($hour)));
    $min = intval(substr($min,0,strlen($min)));
    //echo "hour: ".$hour;
    //echo "minute: ".$min;

    if ($hour != 0){
        $duration = ($hour * 60) + $min;
    }
    else{
        $duration = $min;
    }

    if ($duration != 0){
        insert_time_report($_POST["subject"], $_POST["type"], $duration, intval($_SESSION["id"]));
    }
    else{
        //näita mingit sõnumit
    }


    /*
    $min = intval($arr[1]);
    if (sizeof($arr) == 2){
        $duration = ($hour * 60) + $min;

    echo(insert_time_report($_POST["subject"], $_POST["type"], $duration, intval($_SESSION["id"])));
    }
    else if(sizeof($arr) == 2){

    }*/

}
$submitDay ="Täna";

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
        <a href="../seaded/" class="page" id="tools"><span class="link_names">Seaded</span></a>
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
            <i id="displayDay"><?php echo $submitDay;?></i>
            <i class="arrow right" onclick="changeDay(event)"></i>
        </div>

      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

          <i id="labelForSubjects"><label for="class" id="label">Aine </label></i>
            <?php
                echo getSubjects();
            ?>
      <br />

          <i id="labelForSubjects"><label for="type" id="label">Tüüp </label></i>

        <?php
           echo getActivities();
        ?>
      <br />

          <i id="labelForSubjects"><label for="kulu" id="label">Kulu </label></i>

          <select class="hourSelect" name="hourSelect" >
          <?php

                for($i=0; $i<=12; $i++)
                {

                    echo "<option value=".$i.">".$i."h</option>";
                }
                ?>
          </select>

          <select class="minuteSelect" name="minuteSelect">
              <?php

              for($i=0; $i<=55; $i+=5)
              {

                  echo "<option value=".$i.">".$i."m</option>";
              }
              ?>
          </select>

          <div><button type="submit_button" class="submitButton" >Sisesta</button></div>


      </form>
    </div>


  </body>


</html>
<script>
    let days = ['Täna', 'eile', 'üleeile'];
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