<?php
require("../../../config.php");

function getActivities(){
    $result = null;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn -> prepare("SELECT id, name FROM activities ORDER BY name");
    echo $conn -> error;

    mysqli_set_charset($conn, 'utf8');

    $stmt -> bind_result($idFromDb, $name);
    $stmt -> execute();
    $result .= "<select name=\"type\" class=\"dropdown\">";

    while($stmt -> fetch()){
        $result .= "<option class='option' value=\"".$idFromDb."\">".$name."</option> \n";
    }

    $result .= "</select>";

    $stmt->close();
    $conn->close();
    return $result;
}

function getSubjects(){

    $user_id = $_SESSION["id"];
    $result = null;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn -> prepare("SELECT * FROM subjects WHERE subjects.id IN (SELECT user_subjects.subject_id FROM user_subjects WHERE user_subjects.user_id = ?)");
    echo $conn -> error;
    $stmt->bind_param("i", $user_id);
    $stmt -> bind_result($idFromDb, $nameFromDb, $codeFromDb);
    $stmt -> execute();
    $result .= "<select id=\"subject\" name=\"subject\" class=\"dropdown\">";

    while($stmt -> fetch()){
        $result .= "<option class='option' value=\"".$idFromDb."\">".$nameFromDb."</option> \n";
    }

    $result .= "</select>";

    $stmt->close();
    $conn->close();
    return $result;
}

function getStudents($subject_id){
    $result = null;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn -> prepare("SELECT id, first_name, last_name FROM users WHERE role = 'student' AND id IN (SELECT user_subjects.user_id FROM user_subjects WHERE user_subjects.subject_id = ?) ORDER BY student_code");
    echo $conn -> error;
    $stmt->bind_param("i", $subject_id);
    $stmt -> bind_result($idFromDb, $first_name, $last_name);
    $stmt -> execute();
    $result .= "<select id=\"student\" name=\"student\" class=\"dropdown\">";

    while($stmt -> fetch()){
        $result .= "<option class='option' value=\"".$idFromDb."\">".$first_name." ".$last_name."</option> \n";
    }

    $result .= "</select>";

    $stmt->close();
    $conn->close();
    return $result;
}

