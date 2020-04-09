<?php
require("../../config.php");
session_start();

function signIn($userName, $password){
    $notice = "";
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT password FROM vpusers WHERE email=?");
    echo $conn->error;
    $stmt->bind_param("s", $email);
    $stmt->bind_result($passwordFromDb);
    if($stmt->execute()){
        //kui päring õnnestus
        if($stmt->fetch()){
            //kasutaja on olemas
            if(password_verify($password, $passwordFromDb)){
                //kui salasõna klapib
                $stmt->close();
                $stmt = $conn->prepare("SELECT id,firstname, lastname FROM vpusers WHERE email=?");
                echo $conn->error;
                $stmt->bind_param("s", $email);
                $stmt->bind_result($idFromDb,$firstnameFromDb, $lastnameFromDb);
                $stmt->execute();
                $stmt->fetch();
                //Enne sisselogitud lehtedele jõudmist, sulgeme andmebaasi ühendused
                $notice = "Sisse logis " .$firstnameFromDb ." " .$lastnameFromDb ."!";


                //Salvestame kasutaja info sessioonimuutujasse
                $_SESSION["userFirstName"] = $firstnameFromDb;
                $_SESSION["userLastName"] = $lastnameFromDb;
                $_SESSION["userId"] = $idFromDb;

                $stmt->close();
                $conn->close();

                header("Location: home.php");
                exit();



            } else {
                $notice = "Vale salasõna!";
            }//kas password_verify
        } else {
            $notice = "Sellist kasutajat (" .$email .") ei leitud!";
            //kui sellise e-mailiga ei saanud vastet (fetch ei andnud midagi), siis pole sellist kasutajat
        }//kas fetch õnnestus
    } else {
        $notice = "Sisselogimisel tekkis tehniline viga!" .$stmt->error;
        //veateade, kui execute ei õnnestunud
    }//kas execute õnnestus

    $stmt->close();
    $conn->close();
    return $notice;
}

function signUp($userName, $password){
    $notice = null;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES(?,?)");
    echo $conn->error;

    //tekitame parooli räsi (hash) ehk krüpteerime
    $options = ["cost" => 12, "salt" => substr(sha1("rBffUdkxZ"), 0, 22)];
    $pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bind_param("ss", $userName, $pwdhash);

    if($stmt->execute()){
        $notice = "Kasutaja salvestamine õnnestus!";
    } else {
        $notice = "Kasutaja salvestamisel tekkis tehniline tõrge: " .$stmt->error;
    }

    $stmt->close();
    $conn->close();
    return $notice;
}
