<?php

session_start();

include("functions_calendar.php");

$year = $_POST["year"];
$month = $_POST["month"];
$day = $_POST["day"];

$events = getDayActivities($_SESSION["id"],$month,$year,$day);

echo "<table class=\"popupasi\">
      
        <tbody>
                <tr id=\"kõik\">
                    <th id=\"aine\" class=\"popuptext\">Aine</th>
                    <th id=\"õppetegevus\" class=\"popuptext\">Õppetegevus</th>
                    <th id=\"kestvus\" class=\"popuptext\">kestvus</th>
                </tr>";

//print_r($events);
foreach ($events as $key => $value){
    //print_r($value);
    //print_r(array_keys($value));
    foreach ($value as $key2 => $value2){

        foreach ($value2 as $key3 => $value3){
            $time = $value3["duration"];
            $hours = floor($time / 60);
            $minutes = ($time % 60);
            $temp = "";
            if($hours == 0){
                $temp.= "<td>".$minutes."m</td></tr>";
            }
            else if($minutes == 0){
                $temp.= "<td>".$hours."h</td></tr>";
            }
            else{
                $temp.= "<td>".$hours."h ".$minutes."m</td></tr>";
            }
           // print_r($key3);
            echo "<tr><td>".$key2."</td><td>".$key3."</td>".$temp;
        }



        //print_r($value[$key2]);
    }

}

/*
foreach (array_keys($events[$cur_date]) as $key => $value) {


}*/


//echo "<tr><td>Interaktsioonidisain</td><td>Akadeemiline õppetöö</td><td>10m</td></tr>";
//echo "<tr><td>Üldotstarbelised arendusplatvormid</td><td>Akadeemiline õppetöö</td><td>30m</td></tr>";



echo "</tbody></table>";
//return $events;

