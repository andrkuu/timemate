<?php
require("../../../config.php");


function getMonthActivities($userId, $monthNr, $yearNr){
    $result = null;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

    $beginDate = $yearNr."-".$monthNr."-01 00:00:00";
    $endDate = $yearNr."-".$monthNr."-31 23:59:59";
    $sql = 'SELECT (SELECT name FROM subjects WHERE id = time_reportings.subject_id), 
                                            (SELECT name FROM activities WHERE id = time_reportings.activity_id), 
                                            sum(duration), date(report_date) FROM time_reportings WHERE user_id=?
                                            AND report_date between ? and ?
                                            GROUP BY time_reportings.subject_id, time_reportings.activity_id, DATE(report_date)
                                            ORDER BY report_date ASC
   ';
    $stmt = $conn -> prepare($sql);


    $stmt->bind_param("iss", $userId,$beginDate,$endDate);
    $stmt -> bind_result($subjectFromDb, $activityFromDb, $durationFromDb, $dateFromDb);
    $stmt -> execute();
    echo $stmt->error;
    $events = array();
    while($stmt -> fetch()){
        $result.= $subjectFromDb. $activityFromDb. $durationFromDb. $dateFromDb."<br>";
        $events[$dateFromDb][$subjectFromDb][$activityFromDb]["duration"] = $durationFromDb;

    }

    $stmt->close();
    $conn->close();
    return $events;
}

/*
 * <select id="type">
        <option value="rühm">rühmatöö</option>
        <option value="iseseisev">iseseisev töö</option>
        <option value="kodune">kodune töö</option>
      </select>
 *
 */