<?php
require 'backend/db.php';
date_default_timezone_set("Africa/Nairobi");
header("Access-Control-Allow-Origin: *");
$data=file_get_contents('php://input');
$dba = new DBA();
$db = $dba->db;

if(!empty($data)){
    $json=json_decode($data);
    $Body=$json->Body;$errors=[];
    $stkCallback=$Body->stkCallback;
    $MerchantRequestID=$stkCallback->MerchantRequestID;
    $checkOutId=$stkCallback->CheckoutRequestID;
    $ResultCode=$stkCallback->ResultCode;
    if($ResultCode!=0){
        header("Location: parent.php?error=Payment Failed & Error occured during processing");
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
            try {
                $stmt = $db->prepare("UPDATE payment SET `mpesa_receipt`=:MpesaReceiptNumber, `status`=:status WHERE `query_id`=:checkOutId");
                $stmt->execute([':receipt'=>$MpesaReceiptNumber, ':status'=>'paid', ':checkOutId'=> $checkOutId]);
                header("Location: parent.php?error=Payment successfully processed");
            } catch (\Throwable $th) {
                header("Location: parent.php?error=Payment Failed");
                exit();
            }
        }
    }
}else{
    header("Location: parent.php?error=Payment Failed&$user_data");
    exit();
}

?>