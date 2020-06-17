<?php
    require("functions_login.php");
    require_once('/var/simplesamlphp/lib/_autoload.php');

    session_start();
    $as = new \SimpleSAML\Auth\Simple('timemate');
    $as->isAuthenticated();
    //SimpleSAML_Configuration::setConfigDir('/var/simplesamlphp/lib/simplesaml/config/saml');
    //$as->requireAuth(['ReturnTo' => '/aine']);
    $as->requireAuth(['ReturnTo' => '/login', 'KeepPost' => FALSE]);
    $attributes = $as->getAttributes();
    echo $attributes["uid"][0];
    echo "<br>";
    echo $attributes["displayname"][0];
    echo "<br>";
    echo $attributes["eduPersonAffiliation"][0];
    echo "<br>";
    echo $attributes["tluStudy"][0];
    echo "<br>";
    echo $attributes["tluStudentID"][0];
    echo "<br>";
    $uid = $attributes["uid"][0];
    $displayName = $attributes["displayname"][0];
    $names = explode(" ", $displayName);
    $first_name = $names[0];
    $last_name = $names[1];
    $role = $attributes["eduPersonAffiliation"][0];
    $student_id = $attributes["tluStudentID"][0];


    //print_r($attributes);


    SimpleSAML_Session::getSessionFromRequest()->cleanup();

    $result = check_user($uid);

    $_SESSION["userFirstName"] = $first_name;
    $_SESSION["userLastName"] = $last_name;

    $_SESSION["id"] = $result["id"];
    $_SESSION["found"] = $result["found"];



    if(!$result["found"]){
        echo "not found";
        add_user($uid, $first_name, $last_name, $student_id, $role);
        //header("Location: /login");
    }else{
        echo "found user id".$_SESSION["id"];
        //header("Location: /login");
    }

    if($uid == "andrku"){
        echo "õpetaja";
        header("Location: /opetaja");
    }else{
        header("Location: /aine");
    }






