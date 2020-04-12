<?php

session_start();

/**
 * Returns the calendar's html for the given year and month.
 *
 * @param $year (Integer) The year, e.g. 2015.
 * @param $month (Integer) The month, e.g. 7.
 * @param $events (Array) An array of events where the key is the day's date
 * in the format "Y-m-d", the value is an array with 'text' and 'link'.
 * @return (String) The calendar's html.
 */
function build_html_calendar($year, $month, $events = null) {

    // CSS classes
    $css_cal = 'calendar';
    $css_cal_row = 'calendar-row';
    $css_cal_day_head = 'calendar-day-head';
    $css_cal_day = 'calendar-day';
    $css_cal_day_active = 'calendar-day-event-container';
    $css_cal_day_number = 'day-number';
    $css_cal_day_blank = 'calendar-day-np';
    $css_cal_day_event = 'calendar-day-event';
    $css_cal_event = 'calendar-event';
    $css_cal_alert = "display-alert";


    $headings = ['E', 'T', 'K', 'N', 'R', 'L', 'P'];


    $calendar =
        "<table cellpadding='0' cellspacing='0' class='{$css_cal}'>" .
        "<tr class='{$css_cal_row}'>" .
        "<td class='{$css_cal_day_head}'>" .
        implode("</td><td class='{$css_cal_day_head}'>", $headings) .
        "</td>" .
        "</tr>";


    $running_day = date('N', mktime(0, 0, 0, $month, 1, $year));
    $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));


    $calendar .= "<tr class='{$css_cal_row}'>";

    for ($x = 1; $x < $running_day; $x++) {
        $calendar .= "<td class='{$css_cal_day_blank}'> </td>";
    }

    for ($day = 1; $day <= $days_in_month; $day++) {

        $cur_date = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
        $draw_event = false;
        if (isset($events) && isset($events[$cur_date])) {
            $draw_event = true;
        }

        $calendar .= $draw_event ?
            "<td onclick='tdclick(event)' class='{$css_cal_day_active}'>" :
            "<td onclick='tdclick(event)' class='{$css_cal_day}'>";

        $calendar .= "<div onclick='event.stopPropagation();' class='{$css_cal_day_number}'>" . $day . "</div>";
        $calendar .= $draw_event ?
            "<div class='{$css_cal_alert}'></div>" :
            "";

        if ($draw_event) {

            if (array_key_exists($cur_date,$events)){

                $temp = "";

                foreach (array_keys($events[$cur_date]) as $key => $value) {
                    $temp.= "<li>".$value." ";
                    $temp.= $events[$cur_date][$value]["type"]." ";
                    $temp.= $events[$cur_date][$value]["duration"]."h </li>";
                }

                $calendar .=

                    "<div hidden id='hidden_text'><ul>".$temp.


                    "</ul></div>";

            }
            else{
                $calendar .=
                    "<div class='{$css_cal_event}'>" .
                    "<p>" .

                    $events[$cur_date][array_values($events)[0]] .
                    "</p>" .
                    "</div>";
            }


        }


        $calendar .= "</td>";

        if ($running_day == 7) {
            $calendar .= "</tr>";
            if (($day + 1) <= $days_in_month) {
                $calendar .= "<tr class='{$css_cal_row}'>";
            }
            $running_day = 1;
        }

        else {
            $running_day++;
        }

    }

    if ($running_day != 1) {
        for ($x = $running_day; $x <= 7; $x++) {
            $calendar .= "<td class='{$css_cal_day_blank}'> </td>";
        }
    }

    $calendar .= "</tr>";

    $calendar .= '</table>';

    return $calendar;
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" href="/images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="kalender.css">
    <title>Kalender</title>
      <script>


          function tdclick(e){
              if (!e) var e = window.event;
              e.cancelBubble = true;
              e.stopPropagation();
              let child = e.target.childNodes[0];
              console.log(child.innerText);

          };

          function changeMonth(e){
              console.log(e.target.className);


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
          }

          /* The actual popup */
          .popup .popuptext {
              visibility: hidden;
              width: 160px;
              background-color: #555;
              color: #fff;
              text-align: center;
              border-radius: 6px;
              padding: 8px 0;
              position: absolute;
              z-index: 1;
              bottom: 125%;
              left: 50%;
              margin-left: -80px;
          }

          /* Popup arrow */
          .popup .popuptext::after {
              content: "";
              position: absolute;
              top: 100%;
              left: 50%;
              margin-left: -5px;
              border-width: 5px;
              border-style: solid;
              border-color: #555 transparent transparent transparent;
          }

          /* Toggle this class - hide and show the popup */
          .popup .show {
              visibility: visible;
              -webkit-animation: fadeIn 1s;
              animation: fadeIn 1s;
          }

          /* Add animation (fade in the popup) */
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

    <div class="popup" onclick="myFunction()">klick
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


        echo build_html_calendar(2020, 4,$events);

        ?>
        </div>
        </div>
    <script>
        function myFunction() {
            var popup = document.getElementById("myPopup");
            popup.classList.toggle("show");
        }
    </script>
  </body>
</html>