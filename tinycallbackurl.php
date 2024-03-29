<?php
       // Connect to DB
    include('./Mydb.php');
 	header("Content-Type: application/json");

     $response = '{
         "ResultCode": 0, 
         "ResultDesc": "Confirmation Received Successfully"
     }';
    
     $body ='Body';
     // DATA
     $mpesaResponse = file_get_contents('php://input');
 
     // log the response
     $logFile = "response.json";
    
 
     // write to file
     $log = fopen($logFile, "w");
 
     fwrite($log, $mpesaResponse);
     fclose($log);

     //Processing the Mpesa json response Data
     $mpesaResponse = file_get_contents('response.json');
     $callbackContent = json_decode($mpesaResponse);
     
     
     $Resultcode = $callbackContent->Body->stkCallback->ResultCode;
     $CheckoutRequestID = $callbackContent->Body->stkCallback->CheckoutRequestID;
     $Amount = $callbackContent->Body->stkCallback->CallbackMetadata->Item[0]->Value;
     $MpesaReceiptNumber = $callbackContent->Body->stkCallback->CallbackMetadata->Item[1]->Value;
     $PhoneNumber = $callbackContent->Body->stkCallback->CallbackMetadata->Item[4]->Value;


     if ($Resultcode == 0) {

      // Check connection
      if ($con->connect_error) {
          die("<h1>Connection failed:</h1> " . $con->connect_error);
      } else {
  
       
          $insert = $con->query("INSERT INTO malipo (CheckoutRequestID,ResultCode,amount,MpesaReceiptNumber,PhoneNumber)
           VALUES ('$CheckoutRequestID','$Resultcode','$Amount','$MpesaReceiptNumber','$PhoneNumber')");
          //unset($mpesaResponse);
          if($insert){
            unset($logFile);
          }

          $con = null;
         
      }
  }