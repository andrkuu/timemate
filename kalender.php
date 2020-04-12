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
                  month: 3//$("#tel").val()
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
              myFunction(events.innerText);
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
          .popup {
              position: relative;
              display: inline-block;
              cursor: pointer;
              -webkit-user-select: none;
              -moz-user-select: none;
              -ms-user-select: none;
              user-select: none;
              left: 45.2vw;
              top: -28vh;
          }

          /* The actual popup */
          .popup .popuptext {
              visibility: hidden;
              width: 35vw;
              height: 39.2vw;
              background-color: #555;
              color: #fff;
              text-align: center;
              line-height: 34vw;
              border-radius: 6px;
              padding: 8px 0;
              position: absolute;
              z-index: 1;
              bottom: 125%;
              left: 50%;
              margin-left: -80px;
          }

          .popup .show {
              visibility: visible;
              -webkit-animation: fadeIn 1s;
              animation: fadeIn 1s;
          }

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
        <a href="kalender.php" class="selectedLink" >Kalender</a>
        <a href="seaded.php" class="lingid" id="tools"> Seaded</a>
    </div>

    <div class="popup" onclick="myFunction()">
        <span class="popuptext" id="myPopup">mingi lambine tekst</span>
    </div>

    <div class="kalender">
        <div class="month">
            <ul>
                <li class="prev" onclick="changeMonth(event)">&#10094;</li>
                <li class="next" onclick="changeMonth(event)">&#10095;</li>
                <li>
                    Aprill
                    <span style="font-size:18px">2020</span>
                </li>
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
    <script>



        function myFunction(date) {

            var popup = document.getElementById("myPopup");
            popup.classList.toggle("show");
            popup.innerText = date;
        }
    </script>
  </body>
</html>