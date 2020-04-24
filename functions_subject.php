<?php
require("../../../config.php");

function getActivities(){
    $result = null;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn -> prepare("SELECT id, name FROM activities ORDER BY name");
    echo $conn -> error;
    $stmt -> bind_result($idFromDb, $name);
    $stmt -> execute();
    $result .= "<select name=\"type\" class=\"dropdown\">";

    while($stmt -> fetch()){
        $result .= "<option value=\"".$idFromDb."\">".$name."</option> \n";
    }

    $result .= "</select>";

    $stmt->close();
    $conn->close();
    return $result;
}

function getSubjects(){
    $result = null;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn -> prepare("SELECT id, name, code FROM subjects ORDER BY name");
    echo $conn -> error;
    $stmt -> bind_result($idFromDb, $nameFromDb, $codeFromDb);
    $stmt -> execute();
    $result .= "<select name=\"subject\" class=\"dropdown\">";

    while($stmt -> fetch()){
        $result .= "<option value=\"".$idFromDb."\">".$nameFromDb."</option> \n";
    }

    $result .= "</select>";

    $stmt->close();
    $conn->close();
    return $result;
}

function insert_time_report($subject_id, $activity_id, $duration, $user_id){

    $ret = False;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("INSERT INTO time_reportings (subject_id, activity_id, duration, user_id) VALUES ((?),(?),(?),(?))");

    $stmt->bind_param("iiii", $subject_id,$activity_id, $duration, $user_id);
    if($stmt->execute()){
        $ret = True;
    }else{
        $ret = "Mingi viga: " .$stmt->error;
    }

    $stmt->close();

    $conn->close();

    return  $ret;

}

function getPreviousActivities($userId){
    $result = null;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn -> prepare("SELECT (SELECT name FROM subjects WHERE id = time_reportings.subject_id), 
                                            (SELECT name FROM activities WHERE id = time_reportings.activity_id), 
                                            duration, date FROM time_reportings WHERE user_id=? ORDER BY date");

    echo $conn -> error;
    $stmt->bind_param("i", $userId);
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