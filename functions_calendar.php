<?php
require("../../../config.php");


function getMonthActivities($userId, $monthNr, $yearNr){
    $result = null;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn -> prepare("SELECT (SELECT name FROM subjects WHERE id = time_reportings.subject_id), 
                                            (SELECT name FROM activities WHERE id = time_reportings.activity_id), 
                                            duration, report_date FROM time_reportings WHERE user_id=? AND MONTH(report_date) = ? AND YEAR(report_date) = ?  
                                            GROUP BY subject_id, activity_id, duration
                                            ORDER BY report_date
   ");

    echo $conn -> error;
    $stmt->bind_param("iii", $$userId,$monthNr, $yearNr);
    $stmt -> bind_result($subjectIdFromDb, $activityIdFromDb, $durationFromDb, $dateFromDb);
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

    $events = [
        "2020-04-05" => [
            "Matemaatika" => [
                "type" => "Kodutöö",
                "duration" => 5
            ]
        ],

        "2020-04-07" => [
            "Interaktsioonidisain" => [
                "type" => "Kodutöö",
                "duration" => 3
            ],

            "Java" => [
                "type" => "Kodutöö",
                "duration" => 5
            ]

        ],
    ];

    while($stmt -> fetch()){
        $hours = floor($durationFromDb / 60);
        $minutes = ($durationFromDb % 60);
        $day = date("d",strtotime($dateFromDb));
        $month = date("m",strtotime($dateFromDb));
        $result .=
            "<li>"
                .$day." "
                .ucfirst($months[intval($month)])." "
                .$subjectIdFromDb." "
                .$activityIdFromDb." "
                .$hours."h "
                .$minutes."m  
            </li> \n";
    }

    $result .= "</ul>";

    $stmt->close();
    $conn->close();
    return $result;
}

/*
 * <select id="type">
        <option value="rühm">rühmatöö</option>
        <option value="iseseisev">iseseisev töö</option>
        <option value="kodune">kodune töö</option>
      </select>
 *
 */