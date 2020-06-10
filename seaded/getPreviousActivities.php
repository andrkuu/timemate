<?php
session_start();
require("../../../config.php");

function isMobileDevice()
{
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

if (isMobileDevice()){
    $limit = 6;
}
else{
    $limit = 7;
}

$userId = $_SESSION["id"];

$result = null;
$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
$stmt = $conn -> prepare("SELECT (SELECT name FROM subjects WHERE id = time_reportings.subject_id), 
                                            (SELECT name FROM activities WHERE id = time_reportings.activity_id), 
                                            duration, report_date, id FROM time_reportings WHERE user_id=?  
                                            AND insert_date BETWEEN date(NOW()) and NOW() - INTERVAL -2 DAY                                      
                                            ORDER BY insert_date DESC
                                            LIMIT ".$limit);

echo $conn -> error;
$stmt->bind_param("i", $userId);
$stmt -> bind_result($subjectIdFromDb, $activityIdFromDb, $durationFromDb, $dateFromDb, $idFromDb);
$stmt -> execute();
$result .= "<ul>";


$months = [
    "jaanuar",
    "veebruar",
    "märts",
    "aprill",
    "mai",
    "juuni",
    "juuli",
    "august",
    "september",
    "oktoober",
    "november",
    "detsember"
];

while($stmt -> fetch()){
    $hours = floor($durationFromDb / 60);
    $minutes = ($durationFromDb % 60);
    $day = date("d",strtotime($dateFromDb));
    $month = date("m",strtotime($dateFromDb));
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

    $result .=
        "<li id='one_item_history'>"
        ."<span id='date_box'> <span id='history_day'>".$day."</span>"
        ."<span id='history_month'>".substr(ucfirst($months[intval($month)-1]),0,3)."</span></span>"
        ."<span id='subject_box'> <span id='history_subject'>".$subjectIdFromDb."</span>"
        ."<span id='history_activity'>".$activityIdFromDb."</span></span>"
        ."<img onClick='deleteReporting(this)' src='../images/delete.png' class='delete_activity' id='delete_activity".$idFromDb."'>"
        ."<span id='history_time'>".$temp."</span>
            </li> \n";
}

$result .= "</ul>";

$stmt->close();
$conn->close();
echo $result;
