
<?php

session_start();
include("../functions_subject.php");



if(!isset($_SESSION["id"])){
    header("Location: ../");
    exit();
}



if(isset($_POST["submitSubject"])){



    $min = $_POST["minuteSelect"];
    $hour = $_POST["hourSelect"];

    $minusDays = $_POST["daynr"];

    $hour = intval(substr($hour,0,strlen($hour)));
    $min = intval(substr($min,0,strlen($min)));


    if ($hour != 0){
        $duration = ($hour * 60) + $min;
    }
    else{
        $duration = $min;
    }

    if ($duration != 0){
        if ((0 <= $minusDays) && ($minusDays <= 2)){
           insert_time_report($_POST["subject"], $_POST["type"], $duration, intval($_SESSION["id"]), $minusDays);
        }

    }
    else{
        //näita mingit sõnumit
    }



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
    <script>

        let day = 0;

        function changeDay(e) {
            if(e.id === "leftarrow"){

                if(day < 2){
                    day++;
                }



            }else{
                if(day > 0){
                    day--;
                }
            }

            let labelText = "";

            if(day === 0){
                labelText = "Täna";
            }
            else if(day === 1){
                labelText = "Eile";
            }
            else if(day === 2){
                labelText = "Üleeile";
            }


            document.getElementById("daynr").value = day;
            document.getElementById("displayDay").innerHTML = labelText;
        }



    </script>


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
            <i class="arrow left" onclick="changeDay(this)" id="leftarrow"></i>
            <i id="displayDay">Täna</i>
            <i class="arrow right" onclick="changeDay(this)" id="rightarrow"></i>
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

          <input type="hidden" name="daynr" id="daynr" value="0" />

          <div><button name="submitSubject" type="submit_button" class="submitButton" >Sisesta</button></div>
            <div class="notification">

            </div>

      </form>
    </div>
  </body>
</html>
