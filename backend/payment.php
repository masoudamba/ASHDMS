<?php
session_start();
require 'db.php';
$dba = new DBA();

$url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$access_token = '';



if (isset($_POST['makepayment'])) {
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
        'BusinessShortCode' => '174379',
        'Password' => $password,
        'Timestamp' => $timestamp,
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $amount,
        'PartyA' => $phone,
        'PartyB' => '174379',
        'PhoneNumber' => $phone,
        'CallBackURL' => 'https://ba2c-102-135-169-115.in.ngrok.io/ASHDMS/backend/callback.php',
        'AccountReference' => 'Parent'.$id . $timestamp,
        'TransactionDesc' => 'Parent payment - ' . date("F")
    );

    $data_string = json_encode($curl_post_data);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

    $curl_response = curl_exec($curl);
    
    $data = json_decode($curl_response, true);
  
    $db = $dba->db;
    if ($data['ResponseCode'] == 0) {
        $_SESSION['CheckoutID'] = json_decode($curl_response, true)['CheckoutRequestID'];

        $checkoutId = $data['CheckoutRequestID'];
        $parent_id = $_SESSION['id'];
        
        try {
            $stmt = $db->prepare("INSERT INTO payment(`parent_id`,`phone_number`, `query_id`, `amount`)
                VALUES (:parent_id, :phonenumber, :checkoutId, :amount)");
            $stmt->execute([':parent_id'=>$parent_id, ':phonenumber'=>$phone, ':checkoutId'=>$checkoutId, ':amount'=>$amount]);
            echo "success:".$checkoutId;
        } catch (PDOException $e) {
            $error = $e->getMessage();
            header("Location: parent.php?error=Error occured during processing. Ensure all details are filled and retry");
        }
    }

}

?>