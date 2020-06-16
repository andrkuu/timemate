<?php

require("../../../config.php");

function check_user($uid){

    $result = null;
    $idFromDb = null;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn -> prepare("SELECT id FROM users where uid=?");
    echo $conn -> error;
    $stmt->bind_param("s", $uid);
    $stmt -> bind_result($idFromDb);
    $stmt -> execute();
    $found = false;

    while($stmt -> fetch()){
        $found = true;
    }
    $result = array();
    $result["found"] = $found;
    $result["id"] = $idFromDb;
    return $result;
}

function add_user($uid, $first_name, $last_name, $student_id, $role){
    $notice = null;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

    $stmt = $conn->prepare("INSERT INTO users (uid, first_name, last_name, student_code, role) VALUES(?,?,?,?,?)");
    echo $conn->error;


    $stmt->bind_param("sssss", $uid, $first_name, $last_name, $student_id, $role);

    if($stmt->execute()){
        $notice = "Kasutaja tekitamine!";
    } else {
        $notice = "Kasutaja tekitamisel tekkis tehniline tõrge: " .$stmt->error;
    }

    $stmt->close();
    $conn->close();
    return $notice;
}
