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




print_r($attributes);
