<?php
session_start();
include("./functions_statistics.php");
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
    <script src="chart.js"></script>
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
    <a href="../seaded/" class="page" id="tools"><span class="link_names">Ajalugu</span></a>
</div>

<div class="images">
    <img src="../images/statistics.png" alt="statistics" class="link_icons" id="first_icon">
    <img src="../images/add.png" alt="statistics" class="link_icons" id="second_icon">
    <img src="../images/calendar.png" alt="statistics" class="link_icons" id="third_icon">
    <img src="../images/history.png" alt="statistics" class="link_icons" id="fourth_icon">
</div>
<div id="container">
<ul>
    <li class="prev" onclick="changeWeek(event)">❮</li>
    <li class="next" onclick="changeWeek(event)">❯</li>
    <input type="hidden" id="flag" value="true" />
        <button id="changeView">vaheta vaadet</button>

</ul>
</div>
    <div id="statistics" class="statistics">
        <canvas id="specific_activity" width=500 height=500></canvas>


    </div>
<!-- <button id="toggle" onclick="toggleChart()">näita/peida kõik</button> -->
<div id="statistics_box"></div>
<script>


</script>
<script src="../jquery.js"></script>

    <script>



        var weekNr = 0;


        document.getElementById("changeView").onclick = function () {
            swapCanvases();
            refreshGraph(weekNr);
            weekNr = 0;
        };

        var chartNr = 0;
        var chartType = "";

        var chartTypes = ["week_activities", "subject_activities", "specific_activity"]; //"week_activities", "subject_activities",

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



             /*
             $.each(ds._meta, function(k,v) {
                 //ds._meta[k].hidden = true;
                 console.log(ds._meta[k].hidden);
             })
             /*
             if(flag === 'true') {
                  $("#flag").val("false");
                 ds.hidden = false;
                 $.each(ds._meta, function(k,v) {
                     ds._meta[k].hidden = false;
                 })

             } else if (flag === 'false') {
                 $("#flag").val("true");
                 ds.hidden = true;
                 $.each(ds._meta, function(k,v) {
                     ds._meta[k].hidden = true;
                 })

             }*/


         });
         chart.update();
     }


     function swapCanvases() {

         if (chartNr < 2) {
             chartNr++;
         } else {
             chartNr = 0;

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
            $.ajax(
                {
                    url: chartType + ".php",
                    type: 'POST',
                    dataType: 'text',
                    data: {week: weekNr},
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


        $(document).ready(function () {

            swapCanvases();
            refreshGraph(weekNr);
            weekNr = 0;

        });


    </script>



</body>
</html>