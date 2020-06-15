<?php
session_start();
include("./functions_statistics.php");
include("../functions_subject.php");

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
    <a href="../statistika/" class="page" id="chosen"><span class="link_names">Statistika</span><img src="../images/statistics.png" alt="statistics" class="link_icons" id="first_icon"></a>
    <a href="../aine/" class="page"> <span class="link_names">Aine</span><img src="../images/add.png" alt="statistics" class="link_icons" id="second_icon"></a>
    <a href="../kalender/" class="page" ><span class="link_names">Kalender</span><img src="../images/calendar.png" alt="statistics" class="link_icons" id="third_icon"></a>
    <a href="../seaded/" class="page" id="tools"><span class="link_names">Ajalugu</span><img src="../images/history.png" alt="statistics" class="link_icons" id="fourth_icon"></a>
</div>

<div id="container">
    <?php
    echo getSubjects();
    ?>
<ul>
    <li class="prev" onclick="changeWeek(event)">❮</li>
    <li class="next" onclick="changeWeek(event)">❯</li>
</ul>
    <input type="hidden" id="flag" value="true" />
    <button id="changeView">vaheta vaadet</button>

    <div id="report_count">Õpingute hulk: <?php
        echo total_report_count($_SESSION["id"]);
        ?> päeva</div>
    </div>

<div class="chartWrapper">
    <div id="statistics" class="statistics">

    </div>

</div>

<!-- <button id="toggle" onclick="toggleChart()">näita/peida kõik</button> -->
<div id="statistics_box"></div>
<script>


</script>
<script src="../jquery.js"></script>

    <script>



        var weekNr = 0;

        var chartNr = 0;
        var chartType = "";

        var chartTypes = ["week_activities", "subject_activities", "specific_activity"];


        $(document).ready(function () {

            //swapCanvases();
            refreshGraph(weekNr);


        });


        document.getElementById("subject").onchange = function (){

            var e = document.getElementById("subject");
            var str = e.options[e.selectedIndex].value;
            console.log(str);
            refreshGraph(weekNr);
        };

        document.getElementById("changeView").onclick = function () {
            swapCanvases();
            refreshGraph(weekNr);
            weekNr = 0;
        };


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

         if (chartNr === 2){
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
            console.log(sub);
            $.ajax(
                {
                    url: chartType + ".php",
                    type: 'POST',
                    dataType: 'text',
                    data: {week: weekNr, subject: sub},
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