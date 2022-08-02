<?php
header('Content-Type:application/json');
$response = '{
    "resultCode":0,
    "resultdesc":"Confirmaton recieved successfully"
}';
$stkPushResponse = file_get_contents('php://input');
$logs_file = "Mpesa_logfile";
$log = fopen($logs_file,"a");
fwrite($log,$logs_file);
fclose($log);
echo $response;