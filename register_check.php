<?php 
session_start();

	include("config.php");
    include("function.php");
    
if (isset($_POST['uname']) && isset($_POST['psw'])
&& isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['role']) 
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
$role = validate($_POST['role']);
$email = validate($_POST['email']);
$studentre = "No Reg no";
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
else if(empty($role)){
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

    if('Parent'===$role){
        $studentre = validate($_POST['studentre']);
        
    
        if(empty($studentre)){
            header("Location: register.php?error=Student Reg No. is required&$user_data");
            exit();
        }
        //header("Location: register.php?error=Re Password is required&$user_data");
        //exit();
    }

    // hashing the password
    $psw = md5($psw);
    $pswC = md5($pswC);
    $query = "SELECT * FROM  users WHERE user_name='$uname' ";
    $result = mysqli_query($con, $query);

    //if('Parent'!==$role){
    //    $studentre='No registration No';
    //}

    if (mysqli_num_rows($result) > 0) {
        header("Location: register.php?error=The username is taken try another&$user_data");
        exit();
    }else {
       $query2 = "INSERT INTO users(first_name, last_name ,role,
       email,phone_number, user_name, password, c_password, ref_student_reg) 
       VALUES('$firstname', '$lastname', '$role', '$email','$phone','$uname', '$psw', '$pswC','$studentre')";
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