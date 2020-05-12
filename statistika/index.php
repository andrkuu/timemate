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
        <canvas id="week_activities" width=500 height=500></canvas>
        <canvas id="subject_activities" width=500 height=500></canvas>
    </div>

    <div id="statistics_box"></div>
    <script src="../jquery.js"></script>
    <script>

        var weekNr = 0;



        document.getElementById("changeView").onclick=function(){
            swapCanvases();
            refreshGraph(weekNr);
            weekNr = 0;
        };

        var chartNr = 1;
        var chartType = "";

        var chartTypes = ["week_activities","subject_activities"];

        function swapCanvases(){

            if(chartNr < 1){
                chartNr++;
            }
            else{
                chartNr = 0;

            }



            chartType = chartTypes[chartNr];

            for (let i = 0; i <chartTypes.length ; i++) {
                console.log(chartTypes[i]);
                var canvas = document.getElementById(chartTypes[chartNr]);
                if(chartType === chartTypes[i]){
                    //console.log(chartType + " = " + chartTypes[i]);
                    console.log(chartType + " visible");
                    canvas.style.visibility='visible';
                }else{
                    var canvas = document.getElementById(chartTypes[i]);
                    console.log(chartType + " hidden");
                    canvas.style.visibility='hidden';
                }
            }


            /*

            for (let i = 0; i <chartTypes.length ; i++) {
                if(chartType === chartTypes[chartNr]){
                    console.log(chartType + " = " + chartTypes[chartNr]);
                    //document.getElementById(chartType).style.display = "visible";
                    document.getElementById(chartType).hidden = false;
                    console.log(chartType+" visible");
                }
                else{
                    console.log(chartType + " hidden");
                    //document.getElementById(chartType).style.display = "hidden";
                    document.getElementById(chartType).hidden = true;
                }
            }*/


            $("#statistics_box").innerHTML = "";
            refreshGraph(weekNr);
        }



        swapCanvases();


        function refreshGraph(weekNr){
            console.log("Refrash");


            $.ajax(
                {
                    url: chartType+".php",
                    type: 'POST',
                    dataType: 'text',
                    data: {week: weekNr},
                    success: function (response)
                    {
                        $("#statistics_box").html(response);
                    }
                });

        }


        function changeWeek(e){



                if (e.target.className === "prev"){
                    weekNr++;

                }else if(e.target.className === "next"){
                    if(weekNr > 0){
                        weekNr--;
                    }
                }

            refreshGraph(weekNr);



        }



        $(document).ready(function(){
            refreshGraph(0);

        });


    </script>



</body>
</html>