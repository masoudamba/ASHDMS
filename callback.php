<?php
session_start();

require 'backend/db.php';

date_default_timezone_set("Africa/Nairobi");
header("Access-Control-Allow-Origin: *");
$data = file_get_contents('php://input');
$json = json_decode($data);
$Body = $json->Body;

if ($ResultCode != 0) {
    exit();
}else {
    $stkCallback = $Body->stkCallback;
    $MerchantRequestID = $stkCallback->MerchantRequestID;
    $checkOutId = $stkCallback->CheckoutRequestID;
    $ResultCode = $stkCallback->ResultCode;
    $CallbackMetadata = $stkCallback->CallbackMetadata;
    $Item = $CallbackMetadata->Item;
    $Item = json_decode(json_encode($Item), true);
    $Amount = json_decode(json_encode($Item[0]));;;
    $MpesaReceiptNumber  = json_decode(json_encode($Item[1]));
    $PhoneNumber = json_decode(json_encode($Item[4]));
    $PhoneNumber = $PhoneNumber->Value;
    $MpesaReceiptNumber = $MpesaReceiptNumber->Value;
    $Amount = $Amount->Value;
    confirmPayment($MpesaReceiptNumber, $checkOutId);

}

function confirmPayment($MpesaReceiptNumber = null, $checkOutId = null)
{
    $dba = new DBA();
    $db = $dba->db;
    try {
        $stmt = $db->prepare("UPDATE payment SET `mpesa_receipt`=:MpesaReceiptNumber, `status`=:status WHERE `query_id`=:checkOutId");
        $stmt->execute([':MpesaReceiptNumber' => $MpesaReceiptNumber, ':status' => 'paid', ':checkOutId' => $checkOutId]);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

// function wh_log($log_msg)
// {
//     $log_filename = "log";
//     if (!file_exists($log_filename)) {
//         // create directory/folder uploads.
//         mkdir($log_filename, 0777, true);
//     }
//     $log_file_data = $log_filename . '/log_' . strtotime(date('d-M-Y H:i:s')) . '.log';
//     // if you don't add `FILE_APPEND`, the file will be erased each time you add a log
//     file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
// }
// // call to function

?>