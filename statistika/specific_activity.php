<?php

session_start();

$userId = $_SESSION["id"];
$week = $_POST["week"];



require("../../../config.php");

$result = null;


$colors = ["green","red","blue","cyan","orange","pink","azure","DimGrey","darkslategrey","FireBrick"];

$result.="<script>";


$result.= "
       
        document.getElementById(\"statistics\").innerHTML = '<canvas id=\"specific_activity\"  width=1000px height=700px ></canvas><canvas id=\"week_activities\"></canvas><canvas id=\"subject_activities\" width=500 height=300vh></canvas>';
        var ctx = document.getElementById('specific_activity').getContext('2d');
        
        var chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [\"1900\", \"1950\", \"1999\", \"2050\"],
      datasets: [{
          label: \"Keskmine\",
          type: \"line\",
          borderColor: \"blue\",
          backgroundColor: \"blue\",
          data: [408,547,675,734],
          fill: false
        }, {
          label: \"Akadeemiline õppetöö\",
          type: \"bar\",
          backgroundColor: \"red\",
          data: [408,547,675,734],
        }, {
          label: \"Õppematerjalide lugemine\",
          type: \"bar\",
          backgroundColor: \"orange\",
          backgroundColorHover: \"#3e95cd\",
          data: [133,221,783,2478]
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Mingi graafik'
      },
      legend: { display: true },
      scales: {
        xAxes: [{ stacked: true }],
        yAxes: [{ stacked: true }]
          }
    },
    
    scales: {
                    yAxes: [{
                        display: true,
                        stacked: true,
                        ticks: {
                            display: true,
                            suggestedMin: 0,
                  
                            callback: function(value, index, values) {
                                return  value +' min';
                            }
                        }
                    }],
                        xAxes: [{
                            stacked: true,
                            barThickness: 10
                    }]
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