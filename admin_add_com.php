<?php 
session_start();

	include("Mydb.php");
    
if (isset($_POST['com_FName']) && isset($_POST['com_LName'])
&& isset($_POST['com_email']) && isset($_POST['position']) && isset($_POST['uname']) && isset($_POST['psw'])) {

function validate($data){
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}


$com_FName = validate($_POST['com_FName']);
$com_LName = validate($_POST['com_LName']);

$com_email = validate($_POST['com_email']);
$position = validate($_POST['position']);

$uname= validate($_POST['uname']);
$psw= validate($_POST['psw']);

$teacher = $_POST['teacher_com_id'];

$user_data = '';
$_SESSION['details'] = $teacher;
$_SESSION['data'] = 'refresh';
if (empty($teacher)) {
    $_SESSION['error'] = "Admin id is required";
    header("Location: admin.php");
    exit();
}else if(empty($com_FName)){
    $_SESSION['error'] = "Committee First Name is required";
    header("Location: admin.php");
    exit();
}
else if(empty($com_LName)){
    $_SESSION['error'] = "Committee Last Name is required";
    header("Location: admin.php");
    exit();
}
else if(empty($com_email)){
    $_SESSION['error'] = "Committee email is required";
    header("Location: admin.php");
    exit();
}
else if(empty($position)){
    $_SESSION['error'] = "Committee position is required";
    header("Location: admin.php");
    exit();
}
else if(empty($uname)){
    $_SESSION['error'] = "Committee username is required";
    header("Location: admin.php");
    exit();
}
else if(empty($psw)){
    $_SESSION['error'] = "Committee password is required";
    header("Location: admin.php");
    exit();
}

else{

    
    $query = "SELECT * FROM  teachers WHERE id='$teacher' ";
    $result = mysqli_query($con, $query);
    $psw = md5($psw);

    
    if (mysqli_num_rows($result) < 1) {
        $_SESSION['error'] = "Admin not found";
        header("Location: admin.php");
        exit();
    }else {

        try {

            $query2 = "INSERT INTO committee(first_name, last_name ,email,role,position,username,password) 
            VALUES('$com_FName', '$com_LName', '$com_email','Committee','$position','$uname','$psw')";
            $result2 = mysqli_query($con, $query2);
            if ($result2) {
                $_SESSION['error'] = "New committee has been created successfully";
                header("Location: admin.php");
                exit();
            }else {
                $_SESSION['error'] = "unknown error occurred";
                header("Location: admin.php");
                exit();
            }
        } catch (\Throwable $th) {
            
            $_SESSION['error'] = "unknown error occurred";
            header("Location: admin.php");
            exit();
        }

       
    }
}
	
}else{
	$_SESSION['error'] = "unknown error occurred";
    header("Location: admin.php");
	exit();
}
?>