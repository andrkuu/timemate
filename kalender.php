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
    <script src="jquery.js"></script>

    <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="kalender.css">
    <title>Kalender</title>


      <script>
          $(document).ready(function(){

              $("#calender_box").load("build_calendar.php", {
                  year: 2020, //$("#txtname").val()
                  month: 4//$("#tel").val()
              });
          });
      </script>
      <script>



          function tdclick(e){
              if (!e) var e = window.event;
              e.cancelBubble = true;
              e.stopPropagation();
              let child = e.target.childNodes[0];
              console.log(child.innerText);
              let events = e.target.childNodes[2];
              console.log(events.innerHTML);
              myFunction(events.innerHTML);
          };

          function changeMonth(e){

              if (e.target.className === "prev"){
                  console.log("p");
              }else if(e.target.className === "next"){
                  console.log("n");
              }

          }

      </script>
      <style>
          /* Popup container - can be anything you want */
          /* Popup box BEGIN */
          .popup{
              background:rgba(0,0,0,.4);
              cursor:pointer;
              display:none;
              height:100%;
              position:fixed;
              text-align:center;
              top:0;
              width:100%;
              z-index:10000;
          }
          .popup .helper{
              display:inline-block;
              height:100%;
              vertical-align:middle;
          }
          .popup > div {
              background-color: #fff;
              box-shadow: 10px 10px 60px #555;
              display: inline-block;
              height: auto;
              max-width: 551px;
              min-height: 100px;
              vertical-align: middle;
              width: 60%;
              position: relative;
              border-radius: 8px;
              padding: 15px 5%;
          }
          .popupCloseButton {
              background-color: #fff;
              border: 3px solid #999;
              border-radius: 50px;
              cursor: pointer;
              display: inline-block;
              font-family: arial;
              font-weight: bold;
              position: absolute;
              top: -20px;
              right: -20px;
              font-size: 25px;
              line-height: 30px;
              width: 30px;
              height: 30px;
              text-align: center;
          }
          .popupCloseButton:hover {
              background-color: #ccc;
          }
          .trigger_popup_fricc {
              cursor: pointer;
              font-size: 20px;
              margin: 20px;
              display: inline-block;
              font-weight: bold;
          }
          /* Popup box BEGIN */


          @-webkit-keyframes fadeIn {
              from {opacity: 0;}
              to {opacity: 1;}
          }

          @keyframes fadeIn {
              from {opacity: 0;}
              to {opacity:1 ;}
          }
      </style>
  </head>
  <body>
    <?php include('nav-bar.php'); ?>
    <div class="links">
        <a href="statistika.php" class="lingid"> Statistika</a>
        <a href="aine.php" class="lingid" >Aine</a>
        <a href="kalender.php" class="lingid" id="chosen" >Kalender</a>
        <a href="seaded.php" class="lingid" id="tools"> Seaded</a>
    </div>

    <div class="popup">
        <span class="helper"></span>
        <div>
            <div class="popupCloseButton">&times;</div>
            <div id="myPopup"><p>Add any HTML content<br />inside the popup box!</p></div>

        </div>
    </div>

    <div class="kalender">
        <div class="month">
            <ul>
                <li class="prev" onclick="changeMonth(event)">&#10094;</li>
                <li class="next" onclick="changeMonth(event)">&#10095;</li>
                <div id="container">
                <div id="kuu">kuu</div>
                <div id="aasta">aasta</div>
                </div>
            </ul>
        </div>
        <div id="calender_box">
        <?php
        $events = [
            "2020-04-05" => [
                "Matemaatika" => [
                    "type" => "Kodutöö",
                    "duration" => 5
                ]
            ],

            "2020-04-07" => [
                "Interaktsioonidisain" => [
                    "type" => "Kodutöö",
                    "duration" => 3
                ],

                "Java" => [
                    "type" => "Kodutöö",
                    "duration" => 5
                ]

            ],
        ];

        // print_r($events);

        $event_index = 1;
        //print_r($events["2020-04-07"]);
        $date = "2020-04-06";

        if (array_key_exists($date,$events)){
            foreach (array_keys($events[$date]) as $key => $value) {
                echo $value." ";
                echo($events[$date][$value]["type"]." ");
                echo($events[$date][$value]["duration"]." ");
                echo "<br>";
            }
        }

        $title = key((array_values($events)[$event_index]));
        $content = array_values(array_values($events)[$event_index]);


        ?>
        </div>
        </div>
    <script src="kalender.js"></script>
    <script>


        $('.popupCloseButton').click(function(){
            $('.popup').hide();
        });


        function myFunction(date) {

            var popup = document.getElementById("myPopup");
            popup.classList.toggle("show");
            popup.innerHTML = date;
            $('.popup').show();



        }
    </script>
  </body>
</html>