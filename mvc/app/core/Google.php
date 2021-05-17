<?php

require __DIR__.'/../../public/vendor/autoload.php';

$google_client = new Google_Client();

$google_client->setClientId('282425818642-6nuoe99hhjp7hj40h0nho80vmmr99jge.apps.googleusercontent.com');

$google_client->setClientSecret('mKVmJ1bGUM2NVnsTblNtDJc1');

$google_client->setRedirectUri('http://test.com/home/login');

$google_client->addScope('email');
$google_client->addScope('profile');

//session_start();

?>
