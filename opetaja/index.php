<?php

session_start();
include("functions_teacher.php");

if($_SESSION["role"] == "student"){
    header("Location: ../aine");
}

if(!isset($_SESSION["id"])){
    header("Location: ../");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ee">
<head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" href="../images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="teacher.css">
    <script src="chart.js"></script>
    <title>Ülevaade</title>
    <?php require('../nav-bar.php'); ?>

</head>
<body>
    <div id="subject_container">
        <?php
        echo getSubjects();
        ?>
    </div>

    <div id="student_container">

    </div>




    <ul>
        <li class="prev" onclick="changeWeek(event)">❮</li>
        <li class="next" onclick="changeWeek(event)">❯</li>
    </ul>
    <input type="hidden" id="flag" value="true" />
    <button id="changeView">vaheta vaadet</button>


    <br />

    <div class="chartWrapper">
        <div id="statistics_teacher" class="statistics_teacher">

        </div>

    </div>

    <div id="statistics_box"></div>


<script src="../jquery.js"></script>

<script>



    var weekNr = 0;

    var chartNr = 0;
    var chartType = "";

    var chartTypes = ["specific_activity"];


    $(document).ready(function () {

        //swapCanvases();
        var e = document.getElementById("subject");
        var sub = e.options[e.selectedIndex].value;
        $("#student").innerHTML = getStudents(sub);


        document.getElementById("Links").style.visibility = 'hidden';

    });


    document.getElementById("subject").onchange = function (){

        var e = document.getElementById("subject");
        var sub = e.options[e.selectedIndex].value;
        $("#student").innerHTML = getStudents(sub);

        refreshGraph(weekNr);
    };





    document.getElementById("changeView").onclick = function () {
        swapCanvases();
        refreshGraph(weekNr);
        //weekNr = 0;
    };

    function getStudents(subject_id){
        $.ajax(
            {
                url: "get_students.php",
                type: 'POST',
                dataType: 'text',
                data: {subject_id: subject_id},
                success: function (response) {
                    $("#student_container").html(response);
                    refreshGraph(weekNr);
                    document.getElementById("student").onchange = function () {
                        swapCanvases();
                        refreshGraph(weekNr);
                        //weekNr = 0;
                    };
                }
            });


    }


    function toggleChart(){
        console.log("a");
        var flag = $("#flag").val();
        console.log("testt");
        event.stopPropagation();

        $(chart.series).each(function(s){
            //this.hide();
            console.log(s);
            this.setVisible(false, false);
        });


        chart.data.datasets.forEach(function(ds) {



        });
        chart.update();
    }


    function swapCanvases() {
        /*
        if (chartNr < 2) {
            chartNr++;
        } else {
            chartNr = 0;

        }*/

        if (chartNr === 0){
            var e = document.getElementById("subject");
            e.style.visibility = 'visible';
        }else{
            var e = document.getElementById("subject");
            e.style.visibility = 'hidden';
        }

        chartType = chartTypes[chartNr];

        for (let i = 0; i < chartTypes.length; i++) {
            console.log(chartTypes[i]);
            var canvas = document.getElementById(chartTypes[chartNr]);
            if (chartType === chartTypes[i]) {
                console.log(chartType + " visible");
                canvas.style.visibility = 'visible';
            } else {
                console.log(chartType + " hidden");
                canvas.style.visibility = 'hidden';
            }
        }



        $("#statistics_box").innerHTML = "";
        refreshGraph(weekNr);
    }


    swapCanvases();


    function refreshGraph(weekNr) {


        console.log("Refresh");
        chartType = chartTypes[chartNr];

        var e = document.getElementById("subject");
        var sub = e.options[e.selectedIndex].value;

        var e = document.getElementById("student");
        var stud = e.options[e.selectedIndex].value;

        $.ajax(
            {
                url: chartType + ".php",
                type: 'POST',
                dataType: 'text',
                data: {week: weekNr, subject: sub, student: stud},
                success: function (response) {
                    $("#statistics_box").html(response);
                }
            });

    }


    function changeWeek(e) {

        if (e.target.className === "prev") {
            weekNr++;

        } else if (e.target.className === "next") {
            if (weekNr > 0) {
                weekNr--;
            }
        }

        refreshGraph(weekNr);

    }

</script>


</body>
</html>