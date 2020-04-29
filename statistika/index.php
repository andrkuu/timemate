<?php
session_start();
include("../functions_statistics.php");
if(!isset($_SESSION["id"])){
    header("Location: ../");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" href="../images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="../chart.js"></script>
    <script src="statistics.js"></script>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="statistics.css">
    <title>Statistika</title>
</head>
<body>
<?php include('../nav-bar.php'); ?>
<div class="links">
    <a href="../statistika/" class="page" id="chosen"><span class="link_names">Statistika</span></a>
    <a href="../aine/" class="page"> <span class="link_names">Aine</span></a>
    <a href="../kalender/" class="page"><span class="link_names">Kalender</span></a>
    <a href="../seaded/" class="page" id="tools"><span class="link_names">Seaded</span></a>
</div>

<div class="images">
    <img src="../images/statistics.png" alt="statistics" class="link_icons" id="first_icon">
    <img src="../images/add.png" alt="statistics" class="link_icons" id="second_icon">
    <img src="../images/calendar.png" alt="statistics" class="link_icons" id="third_icon">
    <img src="../images/wrench.png" alt="statistics" class="link_icons" id="fourth_icon">
</div>
<div id="container">
<ul>
    <li class="prev" onclick="changeWeek(event)">❮</li>
    <li class="next" onclick="changeWeek(event)">❯</li>

        <button id="changeView">vaheta vaadet</button>

</ul>
</div>
    <div id="statistics" class="statistics">
        <canvas id="selectedChart" width=500 height=500></canvas>
    </div>

    <div id="statistics_box"></div>
    <script src="../jquery.js"></script>
    <script>

        var weekNr = 0;

        var barChart=document.getElementById('barChart');
        var pieChart=document.getElementById('pieChart');
        var radarChart=document.getElementById('radarChart');

        document.getElementById("changeView").onclick=function(){
            swapCanvases();
            weekNr = 0;
        };

        var chartNr = 2;


        var chartTypes = ["week_activities","subject_activities"];
        var chartType = "week_activities";

        function swapCanvases(){

            if(chartNr < 1){
                chartNr++;
            }
            else{
                chartNr = 0;
            }

            chartType = chartTypes[chartNr];


            console.log(chartType);
            $("#statistics_box").html("");
            $("#statistics_box").load(chartType+".php", {

                week: weekNr
            });
        }



        swapCanvases();

        function changeWeek(e){



                if (e.target.className === "prev"){
                    weekNr++;

                }else if(e.target.className === "next"){
                    if(weekNr > 0){
                        weekNr--;
                    }
                }

            //swapCanvases();



        }

        function refreshGraph(w){
            console.log("A");

        }

        $(document).ready(function(){
            refreshGraph(0);

        });
        /*
        var ctx = document.getElementById('pieChart').getContext('2d');
        var chart = new Chart(ctx, {

            type: 'pie',

            data: {
                labels: ['Vähem aega kulutatud', 'Rohkem aega kulutatud'],
                datasets: [{
                    label: 'Selle nädala aktiivsus',
                    backgroundColor: [
                        'rgb(255,54,44)',
                        'rgb(158,156,160)'
                    ],
                    borderColor: 'rgb(158,156,160)',
                    data: [25,300]
                }]
            },

            options: {}
        });

        var ctx = document.getElementById('radarChart').getContext('2d');
        var chart = new Chart(ctx, {

            type: 'radar',


            data: {

                labels: ['Matemaatika', 'Java', 'PHP', 'Tarkvara testimine'],
                scaleLabel :[{
                    fontSize : 20,
                    fontColor: 'black'
                }],


                datasets: [{
                    label: 'Erinevatele ainetele kulutatud aeg',
                    data: [1, 3, 2, 5],
                    backgroundColor: [
                        'rgba(255,54,44,0.5)'
                    ],
                    borderColor: 'rgba(255,54,44,0.5)',
                }]
            },

            options: {

                scale: {
                    ticks: {
                        beginAtZero: true,
                        max: 5,
                        min: 0,
                        stepSize: 1,
                        fontSize: 25
                    },
                    pointLabels: { fontSize: 25 }
                },



            }
        });



        var weekNr = 0;
        var barChart=document.getElementById('barChart');
        var pieChart=document.getElementById('pieChart');
        var radarChart=document.getElementById('radarChart');

        document.getElementById("test").onclick=function(){
            //swapCanvases();
        };

        var chartNr = 2;

        swapCanvases();

        function swapCanvases(){

            if(chartNr < 2){
                chartNr++;
            }
            else{
                chartNr = 0;
            }

            if(chartNr == 0){
                barChart.style.visibility = 'visible';
                pieChart.style.visibility = 'hidden';
                radarChart.style.visibility = 'hidden';
            }else if(chartNr == 1){
                barChart.style.visibility = 'hidden';
                pieChart.style.visibility = 'visible';
                radarChart.style.visibility = 'hidden';
            }else if(chartNr == 2){
                barChart.style.visibility = 'hidden';
                pieChart.style.visibility = 'hidden';
                radarChart.style.visibility = 'visible';
            }
        }

        function changeWeek(e){

            if (e.target.className === "prev"){
                weekNr--;

            }else if(e.target.className === "next"){
                weekNr++;
            }
            console.log(weekNr);
        }

    refreshGraph(0);*/

    </script>



</body>
</html>