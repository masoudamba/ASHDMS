<?php

include("config.php");
include("function.php");

date_default_timezone_set("Africa/Nairobi");
header("Access-Control-Allow-Origin: *");
$data=file_get_contents('php://input');



$user_data = "details=";
try {
    session_start();
    $user_data = "details=". $_SESSION['ParentID'];
} catch (\Throwable $th) {
//throw $th;                
}

if(!empty($data)){
    $json=json_decode($data);
    $Body=$json->Body;$errors=[];
    $stkCallback=$Body->stkCallback;
    $MerchantRequestID=$stkCallback->MerchantRequestID;
    $checkOutId=$stkCallback->CheckoutRequestID;
    $ResultCode=$stkCallback->ResultCode;
    if($ResultCode!=0){
        session('error','Transaction not successful! Please retry');

        header("Location: parent.php?error=Payment Failed&$user_data");
        exit();

    }else{
        $CallbackMetadata=$stkCallback->CallbackMetadata;
        $Item=$CallbackMetadata->Item;
        $Item=json_decode(json_encode($Item),true);
        $Amount=json_decode(json_encode($Item[0]));
        $MpesaReceiptNumber=json_decode(json_encode($Item[1]));
        $PhoneNumber=json_decode(json_encode($Item[4]));
        $PhoneNumber=$PhoneNumber->Value;
        $MpesaReceiptNumber=$MpesaReceiptNumber->Value;
        $Amount=$Amount->Value;
        if($MpesaReceiptNumber!==null&&$MpesaReceiptNumber!=="")
        {
            // You are suppose to write sql that queries the database to get a transaction on payments tablw where query_id=$checkOutId set receipt number to  MpesaReceiptNumber and status to paid.
            //$checkOutId,$MpesaReceiptNumber
            try {
                
                $sql_cases = "SELECT * FROM payment WHERE query_id = $checkOutId";
                $qry1 = mysqli_query($con, $sql_cases);
                

                if((mysqli_num_rows($qry1)) > 0){
                    $query2 = "UPDATE payment 
                        SET phone_number = '$PhoneNumber', mpesa_receipt = '$MpesaReceiptNumber', status='PAID', 
                        amount='$Amount' WHERE query_id = '$checkOutId'";

                    $result2 = mysqli_query($con, $query2);

                    if ($result2) {
                        header("Location: parent.php?error=Payment successfully processed&$user_data");
                        exit();
                    }else {
                        header("Location: parent.php?error=Payment Failed&$user_data");
                        exit();
                    }

                }



            } catch (\Throwable $th) {
                //throw $th;
                header("Location: parent.php?error=Payment Failed&$user_data");
                exit();
            }
            // redirect to preffered page the error??
            //session('success','Transaction was successful');
            // the table structure for payments is suppose to have the followng structure
            // id
            // user_id
            // phone_number
            // mpesa_receipt
            // query_id
            // amount
            // status

            // i hope that will be of help to you
            // You are suppose to change the call back url on payment.php to point to this file and precede it with required url. You are also suppose to change the action on form to point to payment.php. All the best

        }
    }
}else{
    header("Location: parent.php?error=Payment Failed&$user_data");
    exit();
}

?>