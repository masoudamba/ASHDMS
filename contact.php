<?php
  $name=$_POST['name'];
  $email=$_POST['email'];
  $subject=$_POST['subject'];
  $message=$_POST['message'];

  $email_from = 'otienoamba81@gmail.com';
  
  $email_body = "Name: $name.\n".
                " Email: $email.\n".
                
                " Message: $message.\n";

  $to = "otienoamba81@gmail.com";
  $headers = "from : $email_from";
  //$headers = "Reply To: $email \r\n";
  mail( $to, $subject,$email_body.$headers );
  //header("Location: index.php")

?>