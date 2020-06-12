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


$colors = ["green","red","blue","cyan","orange","pink","azure","DimGrey","darkslategrey","FireBrick"];
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
        
        
        
        
        document.getElementById(\"statistics\").innerHTML = '<canvas id=\"subject_activities\"></canvas><canvas id=\"week_activities\"  width=0px height=0px ></canvas><canvas id=\"specific_activity\"  width=0px height=0px ></canvas>';
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
        backgroundColor: [\"#3e95cd\", \"#8e5ea2\",\"#3cba9f\",\"#e8c3b9\",\"#c45850\",\"#5d5e63\",\"#EFC050\",\"#FF6F61\",\"#8e5ea2\"],
        
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
      
      tooltips: {
          callbacks: {
          label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var meta = dataset._meta[Object.keys(dataset._meta)[0]];
            var total = meta.total;
            var currentValue = dataset.data[tooltipItem.index];
            var percentage = parseFloat((currentValue/total*100).toFixed(1));
            return currentValue + 'm (' + percentage + '%)';
          },
          title: function(tooltipItem, data) {
            return data.labels[tooltipItem[0].index];
            }
        }
    }
      
    }
    
    
    
});
";

$result.="</script>";

if(sizeof($weekActivities) == 0){
    $result = "";

    $result.="<script>";
    $result.= "
   
        document.getElementById(\"statistics\").innerHTML = '<canvas id=\"subject_activities\"><canvas id=\"week_activities\"></canvas>';
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