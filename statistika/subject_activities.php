<?php

session_start();

$userId = $_SESSION["id"];
$week = $_POST["week"];


require("../../../config.php");

$result = null;
$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

$sql = 'SELECT (SELECT name FROM subjects WHERE id = time_reportings.subject_id) AS Name, 
                                            sum(duration) Duration,
                                            week(curdate()) CurrentWeekNumber, 
                                            date_add(date(report_date),interval  -WEEKDAY(date(report_date))+0 day) FirstDayOfWeek, 
                    date_add(date_add(date(report_date),interval  -WEEKDAY(date(report_date))+0 day), interval 6 day) LastDayOfWeek
                    
                                            
                                            
                                            
                                            FROM time_reportings WHERE user_id=?
                                            AND WEEK(date(report_date),1) = WEEK(NOW(),1) -? AND YEAR(date(report_date)) = YEAR(NOW())
                                            GROUP BY time_reportings.subject_id
                                            ORDER BY report_date ASC';
$stmt = $conn -> prepare($sql);


$stmt->bind_param("ii", $userId,$week);
$stmt -> bind_result($subjectFromDb, $durationFromDb, $currentWeekNr,$firstDayOfWeek, $lastDayOfWeek);
$stmt -> execute();
echo $stmt->error;


$colors = ["green","red","blue","cyan","orange","pink"];
$colorsIndex = 0;
$weekSubjects = array();
$weekActivities = array();
while($stmt -> fetch()){

    $weekActivities[$subjectFromDb] = $durationFromDb;

}

foreach ($weekActivities as $key => $value){
    //print_r($key." ".$value);
}





$stmt->close();
$conn->close();
$result.="<script>";
$result.= "
   
        document.getElementById(\"statistics\").innerHTML = '</canvas><canvas id=\"week_activities\" width=500 height=500vh;></canvas><canvas id=\"subject_activities\" width=500 height=500vh>';
        var ctx = document.getElementById('subject_activities').getContext('2d');
        
        var chart = new Chart(ctx, {
    type: 'pie',
    data: {
    ";



$result .="
      labels: [";



$result .= "],";

$result .= "
      datasets: [{
        label: \"Population (millions)\",
        backgroundColor: [\"#3e95cd\", \"#8e5ea2\",\"#3cba9f\",\"#e8c3b9\",\"#c45850\"],
        
        data:[";

$index = 0;
foreach ($weekActivities as $key => $value){
    if($index != sizeof($weekActivities)){
        $result .= "'".$value."',";
    }
    else{
        $result .= "'".$value."'";
    }
    $index += 1;
    //print_r($key." ".$value);
}



$index = 0;
$result .= "]
      }]
      ,
      labels: [
      ";

foreach ($weekActivities as $key => $value){
    if($index != sizeof($weekActivities)){
        $result .= "'".$key."',";
    }
    else{
        $result .= "'".$key."'";
    }
    $index += 1;
    //print_r($key." ".$value);
}

        $result .= "
    ]
      
    },
    options: {
      title: {
        display: true,
        text: '".$firstDayOfWeek." kuni ".$lastDayOfWeek." Nädala tegevused'
      },
      
      
      
    }
});
";
/*
$result .= "labels: [";

for ($x = 0; $x <sizeof($weekSubjects); $x++) {
    if($x != sizeof($weekSubjects)){
        $result .= "'".$weekSubjects[$x]."',";
    }
    else{
        $result .= "'".$weekSubjects[$x]."'";
    }
}

$result .= "],";

//$result.= "datasets: [";

$maxChartValue = 0;

$result .= "
    datasets: [{
        data: [10, 20, 30]
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Red',
        'Yellow',
        'Blue'
    ],
";

foreach ($weekSubjects as $subject) {
    /*
    $result .= "{
                    label: '" . $subject . "',
                    backgroundColor: '" . $colors[$colorsIndex] . "',
                    borderColor: 'rgb(62,162,255)',
                    barThickness: 6,";

    $result.= "datasets: [{
        data: [10, 20, 30]
    }],";



/*
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



$result.= "options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                    display: true,

                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            display: false,
                            suggestedMin: 0,
                               
                            suggestedMax: ".(intval($maxChartValue)+1).",
                            
                            callback: function(value, index, values) {
                                return  value +' min';
                            }
                        }
                    }],
                    xAxes: [{
                        barThickness: 20
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
                                ctx.fillText(data, bar._model.x, bar._model.y - 5);
                            });
                        });
                    }
                },
                      
                
                title: {
                    display: false,
                    text: ''
                },



            },
        });";*/
$result.="</script>";

if(sizeof($weekActivities) == 0){
    $result = "";

    $result.="<script>";
    $result.= "
   
        document.getElementById(\"statistics\").innerHTML = '</canvas><canvas id=\"week_activities\" width=500 height=500vh;></canvas><canvas id=\"subject_activities\" width=500 height=500vh>';
        var ctx = document.getElementById('subject_activities').getContext('2d');
        
        var chart = new Chart(ctx, {
    type: 'pie',
    data: {
        datasets: [{
        data: [1]
    }],

    labels: [
        'Sellel nädalal ei olnud ühtegi sisestust'
    ],
    }
    });
    ";


}

echo $result;

?>