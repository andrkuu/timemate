
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

            echo insert_time_report($_POST["subject"], $_POST["type"], $duration, intval($_SESSION["id"]), $minusDays);
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
            if(e.id === "leftArrowBox"){

                if(day < 2){
                    day++;
                    moveLeft();
                }



            }else{
                if(day > 0){
                    day--;
                    moveRight();
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




        function moveLeft() {
            var elem = document.getElementById("displayDay");
            var pos = -15;
            var id = setInterval(frame, 10);
            function frame() {
                if (pos == 0) {
                    clearInterval(id);
                } else {
                    pos++;
                    elem.style.left = pos + 'vw';
                }
            }
        }
        function moveRight() {
            var elem = document.getElementById("displayDay");
            var pos = 15;
            var id = setInterval(frame, 10);
            function frame() {
                if (pos == 0) {
                    clearInterval(id);
                } else {
                    pos--;
                    elem.style.left = pos + 'vw';
                }
            }
        }
    </script>


  </head>
  <body>
    <?php require('../nav-bar.php'); ?>
    <div class="links">
        <a href="../statistika/" class="page" ><span class="link_names">Statistika</span><img src="../images/statistics.png" alt="statistics" class="link_icons" id="first_icon"></a>
        <a href="../aine/" class="page" id="chosen"> <span class="link_names">Aine</span><img src="../images/add.png" alt="statistics" class="link_icons" id="second_icon"></a>
        <a href="../kalender/" class="page"><span class="link_names">Kalender</span><img src="../images/calendar.png" alt="statistics" class="link_icons" id="third_icon"></a>
        <a href="../seaded/" class="page" id="tools"><span class="link_names">Ajalugu</span><img src="../images/history.png" alt="statistics" class="link_icons" id="fourth_icon"></a>
    </div>
    <div id="inputContainer">
        <div id="arrows">
            <div id="leftArrowBox"  onclick="changeDay(this)"><img src="../images/rightarrow.png" id="leftarrow" alt="left arrow"></div>
            <i id="displayDay">Täna</i>
            <div id="rightArrowBox" onclick="changeDay(this)"><img src="../images/rightarrow.png" id="rightarrow" alt="right arrow"></i></div>
        </div>

      <form method="POST" id="dropdownBox" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div id="courseBox">
          <i id="labelForSubjects"><label for="class" id="label">Kursuse nimi</label></i>
            <?php
                echo getSubjects();
            ?>
         </div>
      <br />
         <div id="labelBox" >

          <i id="labelForSubjects"><label for="type" id="label">Õppetöö tüüp </label></i>

        <?php
           echo getActivities();
        ?>
         </div>
      <br />
        <div id="timeBox">
          <i id="labelForSubjects"><label for="kulu" id="label">Ajakulu </label></i>

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
        </div>
          <input type="hidden" name="daynr" id="daynr" value="0" />

          <div><button name="submitSubject" type="submit_button" class="submitButton" >Sisesta</button></div>
            <div class="notification">

            </div>

      </form>
    </div>
  </body>
</html>
