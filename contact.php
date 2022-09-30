
<?php
    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $subject=$_POST['subject'];
        $email=$_POST['email'];
        $message=$_POST['message'];

        $to='otienoamba81@gmail.com';
        $subject='Agoro Sare High School Displine System';
        $message="Name: ".$name."\n"."Subject: ".$subject."\n". "Message: "."\n\n".$message;
        $headers="From: masoudamba@gmail.com";
        
        if(mail($to, $subject, $message, $headers)){
            echo "<h1>Sent Successfully! Thank you"." ".$name." ,We will contact you shortly!</h1>";
        }
        else{
            echo "Something went wrong";
        }
       

        
    }
?>