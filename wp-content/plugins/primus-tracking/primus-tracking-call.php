<?php
$idNumber = $_POST['id'];


$url = "https://shipprimus.com/tracking.php?trackingNumber=".$idNumber."&format=json";

if ($_SERVER['HTTP_REFERER'] !== 'https://shipprimus.com' || $_SERVER['HTTP_REFERER'] !== 'https://shipprimus.com/v2/') {
    // $url = "http://dev.shipprimus.com/PRIMUS/trunk/manage.php";
    //$url = "http://dev.shipprimus.com/tracking.php?trackingNumber=".$idNumber."&format=json";
}

if ($_SERVER['REMOTE_ADDR'] == '201.212.59.93'){
//echo $_SERVER['HTTP_REFERER'];
}

if(!function_exists('curl_init')) {
    die('cURL not available!');
}
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_FAILONERROR, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($curl);
if ($output === FALSE) {
    echo 'An error has occurred: ' . curl_error($curl) . PHP_EOL;
}
else {
    echo $output;
}
