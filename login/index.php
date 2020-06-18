<?php
    require("functions_login.php");
    require_once('/var/simplesamlphp/lib/_autoload.php');

    session_start();
    $as = new \SimpleSAML\Auth\Simple('timemate');
    $as->isAuthenticated();
    //SimpleSAML_Configuration::setConfigDir('/var/simplesamlphp/lib/simplesaml/config/saml');
    //$as->requireAuth(['ReturnTo' => '/aine']);
    $as->requireAuth(['ReturnTo' => '/login', 'KeepPost' => TRUE]);
    $attributes = $as->getAttributes();
    echo $attributes["uid"][0];
    echo "<br>";
    echo $attributes["displayname"][0];
    echo "<br>";
    echo $attributes["eduPersonAffiliation"][0];
    echo "<br>";

    $uid = $attributes["uid"][0];
    $displayName = $attributes["displayname"][0];
    $names = explode(" ", $displayName);
    $first_name = $names[0];
    $last_name = $names[1];
    $role = $attributes["eduPersonAffiliation"][0];

    if(!isset($attributes["tluStudentID"][0])){
        $student_id = "";
    }else{
        $student_id = $attributes["tluStudentID"][0];
        echo $attributes["tluStudentID"][0];
        echo "<br>";
    }
    //print_r($attributes);


    SimpleSAML_Session::getSessionFromRequest()->cleanup();

    $result = check_user($uid);

    $_SESSION["userFirstName"] = $first_name;
    $_SESSION["userLastName"] = $last_name;

    $_SESSION["id"] = $result["id"];
    $_SESSION["found"] = $result["found"];


    $_SESSION["role"] = $role;

    if(!$result["found"]){
        echo "not found";
        add_user($uid, $first_name, $last_name, $student_id, $role);
        //header("Location: /login");
    }else{
        echo "found user id".$_SESSION["id"];
        //header("Location: /login");
    }


    /*
    if($role == "student" and $uid == "andrku"){
        $_SESSION["role"] = "faculty";
        header("Location: /opetaja");
    }else */

    if($role == "student" and $uid == "andrku"){
        $_SESSION["role"] = "faculty";
        header("Location: /opetaja");
    }else if($role == "student"){
        header("Location: /aine");
    }
    else{
        header("Location: /opetaja");
    }

    /*
    if($uid == "andrku"){
        header("Location: /opetaja");
    }
    else if($uid == "jaagup"){
        header("Location: /aine");
    }
    else if($uid == "rinde"){
        header("Location: /opetaja");
    }
    else if($uid == "inga"){
        //header("Location: /opetaja");
    }
    else{
        header("Location: /aine");
    }*/






