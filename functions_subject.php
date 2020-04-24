<?php
require("../../../config.php");

function getActivities(){
    $result = null;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn -> prepare("SELECT id, name FROM activities ORDER BY name");
    echo $conn -> error;
    $stmt -> bind_result($idFromDb, $name);
    $stmt -> execute();
    $result .= "<select name=\"type\">";

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
    $result .= "<select name=\"subject\">";

    while($stmt -> fetch()){
        $result .= "<option value=\"".$codeFromDb."\">".$nameFromDb."</option> \n";
    }

    $result .= "</select>";

    $stmt->close();
    $conn->close();
    return $result;
}

function insert_load($regNr, $name, $weight_in, $weight_out){

    $ret = False;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("INSERT INTO Truck_Loads (Truck_ID, Load_Name, Weight_IN, 	Weight_OUT) VALUES ((select ID from Trucks where Reg_NR=?), (?),(?),(?))");

    $stmt->bind_param("ssdd", $regNr,$name, $weight_in, $weight_out);
    if($stmt->execute()){
        $ret = True;
    }else{
        $ret = "Uue kauba viga: " .$stmt->error;
    }

    $stmt->close();

    $conn->close();

    return  $ret;

}

/*
 * <select id="type">
        <option value="rühm">rühmatöö</option>
        <option value="iseseisev">iseseisev töö</option>
        <option value="kodune">kodune töö</option>
      </select>
 *
 */