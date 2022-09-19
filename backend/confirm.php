<?php 
session_start();

require 'db.php';

$dba = new DBA();
$db = $dba->db;

if (isset($_POST['confirmPayment'])) {
    $checkoutid = htmlspecialchars(strip_tags($_POST['checkoutid']));
    
    $stmt = $db->prepare("SELECT * FROM payment WHERE `query_id`=:checkoutid AND `status`='paid' LIMIT 1");
    $stmt->execute([':checkoutid'=>$checkoutid]);
    $payment = $stmt->fetch(PDO::FETCH_OBJ);
    if ($payment !== null && $payment->status === "paid") {
        echo "success";
    } else {
        echo "error";
    }
    

}

?>