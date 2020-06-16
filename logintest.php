<?php

require_once('/var/simplesamlphp/lib/_autoload.php');
$as = new \SimpleSAML\Auth\Simple('timemate');
//SimpleSAML_Configuration::setConfigDir('/var/simplesamlphp/lib/simplesaml/config/saml');
//$as->requireAuth();
$as->requireAuth([
    'ReturnTo' => 'http://www.timemate.ee/aine',
    'KeepPost' => FALSE,
]);

$attributes = $as->getAttributes();

session_start();
$_SESSION["userFirstName"] = "Andreas";
$_SESSION["userLastName"] = "Kuuskaru";
$_SESSION["id"] = 1;

header("Location: /aine");


print_r($attributes);
