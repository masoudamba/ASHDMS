<?php
session_start();
require 'backend/db.php';
$dba = new DBA();

$url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$access_token = '';

if (isset($_POST['amount'])) {
    $consumer_secret = 'KEPgfS1AbNtQeRaL';
    $consumer_key = '9u589pJDEzppBPkYbKeYvvrtGGYPtb5F';
    $encodestring = base64_encode($consumer_key . ":" . $consumer_secret);
    $OuathString = 'Basic ' . $encodestring;

    $oauthURL = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $oauthURL);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $encodestring)); //setting a custom header
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $curl_response = curl_exec($curl);
    $json = json_decode($curl_response, true);

    $access_token = $json['access_token'];
    $passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
    $timestamp = '30' . date("ymdhis");
    $password = base64_encode('174379' . $passkey . $timestamp);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $access_token)); //setting custom header

    $amount = (int)htmlspecialchars(strip_tags($_POST["amount"]));
    $phone = htmlspecialchars(strip_tags($_POST["phone"]));
    $name = $_SESSION["name"];
    $id = $_SESSION['id'];

    $curl_post_data = array(
<<<<<<< HEAD
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
=======
        'BusinessShortCode' => '174379',
        'Password' => $password,
        'Timestamp' => $timestamp,
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $amount,
        'PartyA' => $phone,
        'PartyB' => '174379',
        'PhoneNumber' => $phone,
        'CallBackURL' => 'https://f12c-102-135-169-115.in.ngrok.io/ASHDMS/callback.php',
        'AccountReference' => 'Parent'.$id . $timestamp,
        'TransactionDesc' => 'Parent payment - ' . date("F")
>>>>>>> 9529dfc5bcdf820fadb21e6fdf6b0c0cdc94633b
    );

    $data_string = json_encode($curl_post_data);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

    $curl_response = curl_exec($curl);
<<<<<<< HEAD
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
=======
    
    $data = json_decode($curl_response, true);
    $_SESSION['CheckoutID'] = json_decode($curl_response, true)['CheckoutRequestID'];
    
    $db = $dba->db;
    if ($data['ResponseCode'] == 0) {
        $checkoutId = $data['CheckoutRequestID'];
        $parent_id = $_SESSION['id'];
>>>>>>> 9529dfc5bcdf820fadb21e6fdf6b0c0cdc94633b
        
        try {
            $stmt = $db->prepare("INSERT INTO payment(`parent_id`,`phone_number`, `query_id`, `amount`)
                VALUES (:parent_id, :phonenumber, :checkoutId, :amount)");
            $stmt->execute([':parent_id'=>$parent_id, ':phonenumber'=>$phone, ':checkoutId'=>$checkoutId, ':amount'=>$amount]);
            header("Location: parent.php?success=Payment accepted for processing. Check your phone and complete the transaction");
        } catch (PDOException $e) {
            $error = $e->getMessage();
            header("Location: parent.php?error=Error occured during processing. Ensure all details are filled and retry");
        }
    }
}

?>