<?php
require_once('/var/simplesamlphp/lib/_autoload.php');
$as = new \SimpleSAML\Auth\Simple('timemate');
//SimpleSAML_Configuration::setConfigDir('/var/simplesamlphp/lib/simplesaml/config/saml');
$as->requireAuth();

$as->logout([
    'ReturnTo' => 'http://www.timemate.ee',
    'ReturnStateParam' => 'LogoutState',
    'ReturnStateStage' => 'MyLogoutState',
]);
SimpleSAML\Session::getSessionFromRequest()->cleanup();
