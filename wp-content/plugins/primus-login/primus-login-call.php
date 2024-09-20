<?php
session_start();
if (isset($_SESSION['userName']) && !empty($_SESSION['userName'])) {
    echo json_encode(array('status' => 'Started'));
} else {
    echo json_encode(array('status' => 'NotStarted'));
}
// die();

// session_start();
// var_export($_SERVER);
// var_export($_SESSION);
$url = "https://www." . $_SERVER['HTTP_HOST'] . "/PRIMUS/trunk/checkSession.php";

if (!function_exists('curl_init')) {
    die('cURL not available!');
}
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
$params = '';
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($_POST));
curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
curl_setopt($curl, CURLOPT_FAILONERROR, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($curl);
if ($output === FALSE) {
    echo 'An error has occurred: ' . curl_error($curl) . PHP_EOL;
} else {
    echo json_encode($output);
}
