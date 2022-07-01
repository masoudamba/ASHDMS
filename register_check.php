<?php 
session_start();

	include("config.php");
    
    
if (isset($_POST['uname']) && isset($_POST['psw'])
&& isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['TSCNo']) 
&& isset($_POST['email'])
&& isset($_POST['phone'])
&& isset($_POST['pswC'])) {

function validate($data){
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}


$uname = validate($_POST['uname']);
$psw = validate($_POST['psw']);

$pswC = validate($_POST['pswC']);
$firstname = validate($_POST['firstname']);
$lastname = validate($_POST['lastname']);
$TSCNo = validate($_POST['TSCNo']);
$email = validate($_POST['email']);

$phone = validate($_POST['phone']);


$user_data = 'uname='. $uname. '&psw='. $psw;
if (empty($uname)) {
    header("Location: register.php?error=User Name is required&$user_data");
    exit();
}else if(empty($psw)){
    header("Location: register.php?error=Password is required&$user_data");
    exit();
}
else if(empty($pswC)){
    header("Location: register.php?error=confirm Password is required&$user_data");
    exit();
}
else if(empty($firstname)){
    header("Location: register.php?error=firstname is required&$user_data");
    exit();
}
else if(empty($email)){
    header("Location: register.php?error=email is required&$user_data");
    exit();
}
else if(empty($phone)){
    header("Location: register.php?error=phone is required&$user_data");
    exit();
}
else if(empty($TSCNo)){
    header("Location: register.php?error=Re Password is required&$user_data");
    exit();
}

else if(empty($lastname)){
    header("Location: register.php?error=last name is required&$user_data");
    exit();
}

else if($psw !== $pswC){
    header("Location: register.php?error=The confirmation password  does not match&$user_data");
    exit();
}
else{

    // hashing the password
    $psw = md5($psw);
    $pswC =md5($pswC);
    $query = "SELECT * FROM staff WHERE user_name='$uname' ";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        header("Location: register.php?error=The username is taken try another&$user_data");
        exit();
    }else {
       $query2 = "INSERT INTO staff(first_name, last_name ,tsc_number,
       email,phone_number, user_name, password, c_password) 
       VALUES('$firstname', '$lastname', '$TSCNo', '$email','$phone','$uname', '$psw', '$pswC')";
       $result2 = mysqli_query($con, $query2);
       if ($result2) {
            header("Location: login.php?success=Your account has been created successfully");
         exit();
       }else {
               header("Location: register.php?error=unknown error occurred&$user_data");
            exit();
       }
    }
}
	
}else{
	header("Location: register.php");
	exit();
}
?>