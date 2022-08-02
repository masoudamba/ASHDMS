<?php

if(isset($_POST['Pay'])){
    date_default_timezone_set("Africa/Nairobi");
    $consumerKey ='';
    $consumerSecret ='';
    
    $BussinessShortCode ='';
    $PassKey ='';

    $PartyA = $_POST['phone'];
    $AccountReference = '';

    $TransactionDesc = '';
    $Amount =$_POST['amount'];

    $Timestamp = date('YmdHis');

    $password = base64_encode($BussinessShortCode.$PassKey.$Timestamp);
    $headers = ['Content-Type:application/json; charset = utf8'];

    $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

    $CallBackUrl ='https://localhost:80/ASHDMS/callback_url.php';
    $curl = curl_init($access_token_url);
    curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);
    curl_setopt($curl,CURLOPT_HEADER,FALSE);
    curl_setopt($curl,CURLOPT_USERPWD,$consumerKey.':'.$consumerSecret);
    $results = curl_exec($curl);
    $status = curl_getinfo($curl,CURLINFO_HTTP_CODE);
    $results = json_decode($results);
    $access_token = $results->access_token;
    $stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];


    $curl = curl_init();
    curl_setopt($curl,CURLOPT_URL,$initiate_url);
    curl_setopt($curl,CURLOPT_HTTPHEADER,$stkheader);

    $curl_opt_data = array(
        'BusinessShortCode'=>$BussinessShortCode,
        'Password'=>$password,
        'Timestamp'=>$Timestamp,
        'TransactionType'=>'CustomerPayBillOnline',
        'Amount'=>$Amount,
        'PartyA'=>$PartyA,
        'PartyB'=>$BussinessShortCode,
        'PhoneNumber'=>$PartyA,
        'CallBackUrl'=>$CallBackUrl,
        'AccountReference'=>$AccountReference,
        'TransactionDescription'=>$TransactionDesc
    );
    $data_back = json_decode($curl_opt_data);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_POST,true);
    curl_setopt($curl,CURLOPT_POSTFIELDS,$data_back);
    $curl_response = curl_exec($curl);
    print_r($curl_response);
    echo $curl_response;
}

?>