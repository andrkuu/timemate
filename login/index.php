<?php
    require("functions_login.php");
    require_once('/var/simplesamlphp/lib/_autoload.php');
    session_start();

    $as = new \SimpleSAML\Auth\Simple('timemate');
    //SimpleSAML_Configuration::setConfigDir('/var/simplesamlphp/lib/simplesaml/config/saml');
    $as->requireAuth(['ReturnTo' => '/aine']);
    $attributes = $as->getAttributes();
    echo $attributes["uid"][0];
    echo $attributes["displayname"][0];
    echo $attributes["eduPersonAffiliation"][0];
    echo $attributes["tluStudy"][0];
    echo $attributes["preferredLanguage"][0];

    SimpleSAML_Session::getSessionFromRequest()->cleanup();


    //

    //print_r($attributes);
    $uid = $attributes["uid"][0];
    $displayName = $attributes["displayname"][0];
    $names = explode(" ", $displayName);
    $first_name = $names[0];
    $last_name = $names[1];
    $role = $attributes["eduPersonAffiliation"][0];
    $student_id = $attributes["tluStudentID"][0];

    $_SESSION["userFirstName"] = $first_name;
    $_SESSION["userLastName"] = $last_name;
    //var_dump($uid);
    //echo("test ".$attributes["uid"][0]);
    $result = check_user($uid);



    if(!$result["found"]){
        echo "not found";
        add_user($uid, $first_name, $last_name, $student_id, $role);
    }else{

        echo "found user id".$result["id"];
    }

    $_SESSION["id"] = $result["id"];



