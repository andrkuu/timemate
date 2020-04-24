<?php

session_start();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" href="../images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="../jquery.js"></script>

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="calendar.css">
    <title>Kalender</title>


    <script>

    </script>
    <script>

        var dateObj = new Date();
        var month = dateObj.getUTCMonth() + 1;
        var year = dateObj.getUTCFullYear();


        const capitalize = (s) => {
            if (typeof s !== 'string') return ''
            return s.charAt(0).toUpperCase() + s.slice(1)
        }

        function refreshCalendar(y,m){
            $(document).ready(function(){

                $("#calender_box").load("build_calendar.php", {
                    year: y,
                    month: m
                });
            });

            let kuuContainer = document.querySelector("#kuu");
            let aastaContainer = document.querySelector("#aasta");

            let months = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"]

            kuuContainer.innerHTML = capitalize(months[m-1]);
            aastaContainer.innerHTML = y;

        }

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
                if(month === 1){
                    month = 12;
                    year = year - 1;
                }
                else{
                    month = month - 1;
                }

            }else if(e.target.className === "next"){
                console.log("n");
                if(month === 12){
                    month = 1;
                    year = year + 1;
                }
                else{
                    month = month + 1;
                }
            }

            refreshCalendar(year,month);

        }



        refreshCalendar(year,month);


    </script>

    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .popup {
            height: 25%;
            color: black;
            position: fixed;
            right: 3vw;
            width: 20vw;
            z-index: 1;
            top: 5vw;
            background-color: #c8c8c8;
            overflow-x: visible;
            transition: 3s;
            padding-top: 60px;
        }
        /* SIDEBAR HIDDEN STATE */
        .popup[aria-hidden="true"] {
            transition: 200ms;
            transform: translateX(100%);
        }
        /* SIDEBAR VISIBLE STATE */
        .popup:not([aria-hidden]),
        .popup[aria-hidden="false"] {
            transition: 200ms;
            transform: translateX(0);
        }

        .popup a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 5s;
        }

        .popup a:hover {
            color: #f1f1f1;
        }

        .popupCloseButton {
            position: absolute;
            top: 0;
            cursor: pointer;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

    </style>

</head>
<body>
<?php require('../nav-bar.php'); ?>
<div class="links">
    <a href="../statistika/" class="page"> Statistika</a>
    <a href="../aine/" class="page" >Aine</a>
    <a href="../kalender/" class="page" id="chosen" >Kalender</a>
    <a href="../seaded/" class="page" id="tools"> Seaded</a>
</div>

<div id="popup" class="popup">
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
<script src="calendar.js"></script>
<script>

    refreshCalendar(year,month);
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