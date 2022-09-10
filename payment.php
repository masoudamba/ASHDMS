<?php

include("config.php");
include("function.php");

session_start();

$user_data = "details=";
try {
    //session_start();
    $user_data = "details=". $_SESSION['ParentID'];
} catch (\Throwable $th) {
//throw $th;                
}

$errorDB = "Payment Request Sent";

if (isset($_POST['amount'])) {
    $amount = htmlspecialchars(strip_tags($_POST["amount"]));
    $phone = htmlspecialchars(strip_tags($_POST["phone"]));

    $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    $access_token = '';
    $consumer_secret = 'hOAX5KXA3OSUmoqc';
    $consumer_key = '9qpMAObAcG4WRDWDPb5ykegBXpNlTAOq';
    $encodestring = base64_encode($consumer_key.":".$consumer_secret);

    $oauthURL = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $oauthURL);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$encodestring));
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);
    $json = json_decode($curl_response, true);

    $access_token = $json['access_token'];
    $passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
    $timestamp = '30'.date("ymdhis");
    $password = base64_encode('174379'.$passkey.$timestamp);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token));

    $curl_post_data = array(
    'BusinessShortCode' => '174379',
    'Password' => $password,
    'Timestamp' => $timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $amount,
    'PartyA' => $phone,
    'PartyB' => '174379',
    'PhoneNumber' => $phone,
    'CallBackURL' => 'https://ce98-105-163-0-205.ap.ngrok.io/ASHDMS/callback.php',
    'AccountReference' => $_SESSION["ParentID"].' '.$timestamp ,
    'TransactionDesc' => 'Paybill online - '.date("F")
    );

    $data_string = json_encode($curl_post_data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    $curl_response = curl_exec($curl);
    $data_string= json_decode($curl_response, true);

    if(isset($data_string["ResponseCode"]) && $data_string["ResponseCode"] == 0){
        $_SESSION['CheckoutID'] = $data_string['CheckoutRequestID'];
        $checkoutId = $data_string['CheckoutRequestID'];
        // You are suppose to write a sql statement to save below data to the database
        $parentID = $_SESSION["ParentID"];
        $sessionId = 0;
        $sql_cases = "INSERT INTO payment (parent_id, user_id, phone_number, query_id,
            amount) VALUES ($parentID, $sessionId, $phone, $checkoutId, $amount)";
        try {
            $qry1 = mysqli_query($con, $sql_cases);
        } catch (\Throwable $th) {
            throw $th;
        }
        die('kdjjjd');
        return true;
        
    }elseif ($data_string["errorCode"] == "400.002.02") {
       $_SESSION['error'] = $data_string["errorMessage"];
       $errorDB = "Payment Request Failed";
        return false;
    }else {
        $errorDB = "Payment Request Failed";
        return false;
    }
}else{
    $errorDB = "Payment Request Failed";
}

try {
    header("Location: parent.php?error=$errorDB&$user_data");
	exit();
} catch (\Throwable $th) {
    //throw $th;
}

?>