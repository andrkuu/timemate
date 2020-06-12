<?php

require("../../../config.php");

$conn2 = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

$subject = 7;
$userId = 1;
$week = 0;

$sql = '
    SELECT 
        (SELECT name FROM subjects WHERE id = time_reportings.subject_id), 
            		
                    avg(duration),              
                    WEEKDAY(date(report_date))+1 DayNumber
                    
                    
                    FROM time_reportings 
                    WHERE time_reportings.subject_id = ?
                    AND time_reportings.user_id <> ?
                    AND WEEK(date(report_date),1) = WEEK(NOW(),1) -? 
                    AND YEAR(date(report_date)) = YEAR(NOW())
                            GROUP BY DATE(report_date), time_reportings.subject_id 
                            ORDER BY report_date ASC';
$stmt2 = $conn2 -> prepare($sql);


$stmt2->bind_param("iii", $subject,$userId, $week);
$stmt2 -> bind_result($avgSubjectFromDb, $avgDurationFromDb, $avgDayNr);
$stmt2 -> execute();

$avgActivities = array();

$temp = null;
while($stmt2 -> fetch()) {

    $avgActivities[$avgDayNr] = $avgDurationFromDb;
}

for ($x = 1; $x <=7; $x++) {

    if (!empty($avgActivities[$x])){

        if ($x != 7){
            $temp.= $avgActivities[$x].", ";
        }
        else{
            $temp.= $avgActivities[$x]."";

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

echo $temp;
