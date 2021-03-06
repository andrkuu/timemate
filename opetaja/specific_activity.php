<?php

session_start();

$userId = $_POST["student"];
$week = $_POST["week"];
$subject = $_POST["subject"];


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
                    AND time_reportings.subject_id = ?
                    AND WEEK(date(report_date),1) = WEEK(NOW(),1) -? 
                    AND YEAR(date(report_date)) = YEAR(NOW())
                            GROUP BY YEAR(time_reportings.report_date), MONTH(time_reportings.report_date), DAY(time_reportings.report_date), time_reportings.subject_id, time_reportings.activity_id
                            ORDER BY report_date ASC';
$stmt = $conn -> prepare($sql);


$stmt->bind_param("iii",$userId, $subject, $week);
$stmt -> bind_result($subjectFromDb, $activityFromDb, $durationFromDb, $reportDateFromDb, $firstDayOfWeek, $lastDayOfWeek, $weekNr, $dayNr);
$stmt -> execute();
echo $stmt->error;


/////////////////////////////////

$conn2 = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);



$sql = '
    SELECT 
        (SELECT name FROM subjects WHERE id = time_reportings.subject_id), 
            		
                    avg(duration),              
                    WEEKDAY(date(report_date))+1 DayNumber,
                    week(curdate()) CurrentWeekNumber, 
                    date_add(date(report_date),interval  -WEEKDAY(date(report_date))+0 day) FirstDayOfWeek, 
                    date_add(date_add(date(report_date),interval  -WEEKDAY(date(report_date))+0 day), interval 6 day) LastDayOfWeek
                    
                    FROM time_reportings 
                    WHERE time_reportings.subject_id = ?
                    AND WEEK(date(report_date),1) = WEEK(NOW(),1) -? 
                    AND YEAR(date(report_date)) = YEAR(NOW())
                            GROUP BY DATE(report_date), time_reportings.subject_id 
                            ORDER BY report_date ASC';
$stmt2 = $conn2 -> prepare($sql);


$stmt2->bind_param("ii", $subject, $week);
$stmt2 -> bind_result($avgSubjectFromDb, $avgDurationFromDb, $avgDayNr, $currentWeekNr, $firstDayOfWeek, $lastDayOfWeek);
$stmt2 -> execute();

$avgActivities = array();

$avgValues = null;
while($stmt2 -> fetch()) {

    $avgActivities[$avgDayNr] = $avgDurationFromDb;
}

for ($x = 1; $x <=7; $x++) {

    if (!empty($avgActivities[$x])){

        if ($x != 7){
            $avgValues.= $avgActivities[$x].", ";
        }
        else{
            $avgValues.= $avgActivities[$x]."";

        }
    }
    else{
        if ($x != 7){
            $avgValues.= "0, ";
        }
        else{
            $avgValues.= "0";
        }
    }

}





///////////////////////////////////////





$colors = ["green","darkslategrey","blue","cyan","orange","pink","azure","DimGrey","red","FireBrick"];




$result.="<script>";

$weekSubjects = array();
$weekActivities = array();

while($stmt -> fetch()){

    if (in_array($activityFromDb, $weekActivities)) {

        $weekActivities[$activityFromDb][$dayNr] = $durationFromDb;
    }
    else{
        //array_push($weekActivities, $activityFromDb);
        $weekActivities[$activityFromDb][$dayNr] = $durationFromDb;
    }

}
//print_r($weekActivities);
//print_r($weekActivities["Akadeemiline õppetöö"]);

$maxChartValue = 0;
$colorsIndex = 0;
$temp = "";
foreach (array_keys($weekActivities) as $activity) {

    $temp .= "{";
    $temp .= "label:\"".$activity."\",";
    $temp .= "type: \"bar\",";
    $temp .= "backgroundColor: \"".$colors[$colorsIndex]."\",";
    $colorsIndex += 1;
    //print_r($activity);
    $temp .= "data: [";
    //print_r($weekActivities[$activity]);
    //print_r($weekActivities[$weekActivities[$activity]]);
    for ($x = 1; $x <=7; $x++) {


        //$result.="";
        if (!empty($weekActivities[$activity][$x])){
            //echo $x." - " .$weekActivities[$subject][$x]."<br>";

            if ($weekActivities[$activity] > $maxChartValue){
                $maxChartValue = $weekActivities[$activity][$x];
            }

            if ($x != 7){
                $temp.= $weekActivities[$activity][$x].", ";
            }
            else{
                $temp.= $weekActivities[$activity][$x]."";

            }
        }
        else{
            if ($x != 7){
                $temp.= "0, ";
            }
            else{
                $temp.= "0";
            }
        }

    }
    $temp .= "],";
    $temp .= "},";
    //echo $temp;

}

/*
 * {
          label: "Akadeemiline õppetöö",
          type: "bar",
          backgroundColor: "red",
          data: [408,547,675,734],
        },
 *
 */

//print_r($weekActivities);



$result.= "
       
        document.getElementById(\"statistics_teacher\").innerHTML = '<canvas id=\"specific_activity\" ></canvas>';
        var ctx = document.getElementById('specific_activity').getContext('2d');
        
        var chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Esmaspäev', 'Teisipäev', 'Kolmapäev', 'Neljapäev', 'Reede', 'Laupäev', 'Pühapäev'],
      datasets: [{
          label: \"Keskmine\",
          type: \"line\",
          borderColor: \"red\",
          backgroundColor: \"red\",
          data: [".$avgValues."],
          fill: false,
          lineTension: 0.15,  
          
        }, 
        
        
        ".$temp."
        
      ]
    },
    options: {
      title: {
        display: true,
        text: '".$firstDayOfWeek." kuni ".$lastDayOfWeek." Nädala tegevused'
      },
      legend: { display: true },
      scales: {
        xAxes: [{ 
        
        stacked: true 
        
        }],
        yAxes: [{ 
        
        stacked: true, 
        
        display: true,
                        ticks: {
                            display: true,
                            suggestedMin: 0,
                               
                            suggestedMax: ".(intval($maxChartValue)+20).",
                            
                            callback: function(value, index, values) {
                                return  value +' min';
                            }
                        }
        
        }]
          }
    },
    
   
    
});

        
       ";











/*
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
*/
$result.="</script>";


echo $result;

?>