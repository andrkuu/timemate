<?php

session_start();

$userId = $_SESSION["id"];
$week = $_POST["week"];



require("../../../config.php");

$result = null;
$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

$sql = '
    SELECT 
        (SELECT name FROM subjects WHERE id = time_reportings.subject_id), 
            (SELECT name FROM activities WHERE id = time_reportings.activity_id), 
                    sum(duration), 
                    date(report_date),
                    date_add(date(report_date), 
                    interval  -WEEKDAY(date(report_date))+0 day) FirstDayOfWeek, 
                    date_add(date_add(date(report_date), 
                    interval  -WEEKDAY(date(report_date))+0 day), interval 6 day) LastDayOfWeek,
                    week(curdate()) CurrentWeekNumber,
                    WEEKDAY(date(report_date))+1 DayNumber
                    
                    FROM time_reportings 
                    WHERE user_id=?
                    AND WEEK(date(report_date),1) = WEEK(NOW(),1) -? 
                    AND YEAR(date(report_date)) = YEAR(NOW())
                            GROUP BY time_reportings.subject_id, DATE(report_date)
                            ORDER BY report_date ASC';
$stmt = $conn -> prepare($sql);


$stmt->bind_param("ii", $userId,$week);
$stmt -> bind_result($subjectFromDb, $activityFromDb, $durationFromDb, $reportDateFromDb,$firstDayOfWeek,$lastDayOfWeek,$weekNr,$dayNr);
$stmt -> execute();
echo $stmt->error;


$colors = ["green","red","blue","cyan","orange","pink"];
$colorsIndex = 0;
$weekSubjects = array();
$weekActivities = array();
while($stmt -> fetch()){

    if (in_array($subjectFromDb, $weekSubjects)) {

        $weekActivities[$subjectFromDb][$dayNr] = $durationFromDb;
    }
    else{
        array_push($weekSubjects,$subjectFromDb);
        $weekActivities[$subjectFromDb][$dayNr] = $durationFromDb;
    }

}

$stmt->close();
$conn->close();
$result.="<script>";
$result.= "
       
        document.getElementById(\"statistics\").innerHTML = '<canvas id=\"subject_activities\" width=500 height=500></canvas><canvas id=\"week_activities\" width=500 height=500vh></canvas>';
        var ctx = document.getElementById('week_activities').getContext('2d');

        

        var chart = new Chart(ctx, {

            type: 'bar',

            data: {
                labels: ['Esmaspäev', 'Teisipäev', 'Kolmapäev', 'Neljapäev', 'Reede', 'Laupäev', 'Pühapäev'],
                datasets: [";


$maxChartValue = 0;


foreach ($weekSubjects as $subject) {
    $result .= "{
                    label: '" . $subject . "',
                    backgroundColor: '" . $colors[$colorsIndex] . "',
                    borderColor: 'rgb(62,162,255)',
                    barThickness: 2,";

    $result.= "data: [";


    for ($x = 1; $x <=7; $x++) {


        $result.="";
        if (!empty($weekActivities[$subject][$x])){
            //echo $x." - " .$weekActivities[$subject][$x]."<br>";

            if ($weekActivities[$subject][$x] > $maxChartValue){
                $maxChartValue = $weekActivities[$subject][$x];
            }

            if ($x != 7){
                $result.= $weekActivities[$subject][$x].", ";
            }
            else{
                $result.= $weekActivities[$subject][$x]."";

            }
        }
        else{
            if ($x != 7){
                $result.= ", ";
            }
            else{
                $result.= "";
            }
        }

    }
    $colorsIndex += 1;
    $result.="]},";

}



if(sizeof($weekActivities) == 0){
    $labelText = "Sellel nädalal ei olnud ühtegi sisestust";
}else{
    $labelText = $firstDayOfWeek." kuni ".$lastDayOfWeek." Nädala tegevused";
}


$result.= "]},";

$result.= "options: {
                

                responsive: true,
                legend: {
                    position: 'bottom',
                    display: true,
                    align: 'left',
                    rowCount: 2,
                    columnCount: 2 
                    
                },
               
                
                
                
                options: {
      title: {
        display: true,
        text: '".$labelText."'
      },
      
      
      
      
    },
    
   
                
                tooltips: {
                enabled: true,
                yAlign: 'bottom',
                    callbacks: {
                        labelColor: function(tooltipItem, chart) {
                            var dataset = chart.config.data.datasets[tooltipItem.datasetIndex];
                            return {
                                backgroundColor : dataset.backgroundColor
                            }
                        },
                    },
                backgroundColor: '#227799'
                
                },
                
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            display: true,
                            suggestedMin: 0,
                               
                            suggestedMax: ".(intval($maxChartValue)+1).",
                            
                            callback: function(value, index, values) {
                                return  value +' min';
                            }
                        }
                    }],
                    xAxes: [{
                        barThickness: 10
                    }]
                },";

$result.= "\"hover\": {
                    \"animationDuration\": 0
                },
                \"animation\": {
                    \"onComplete\": function () {
                        var chartInstance = this.chart,
                            ctx = chartInstance.ctx;

                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function (dataset, i) {
                            var meta = chartInstance.controller.getDatasetMeta(i);
                            meta.data.forEach(function (bar, index) {
                                var data = dataset.data[index];
                                //ctx.fillText(data, bar._model.x, bar._model.y - 5);
                            });
                        });
                    }
                },
                      
                title: {
                    display: true,
                    text: '".$labelText."'
                }
      
                                
        },
            
       
            
            
            
        });";
$result.="</script>";

echo $result;

?>