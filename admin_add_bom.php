<?php 
session_start();

	include("Mydb.php");
    
if (isset($_POST['bom_FName']) && isset($_POST['bom_LName'])
&& isset($_POST['bom_email']) && isset($_POST['position']) && isset($_POST['uname']) && isset($_POST['psw'])) {

function validate($data){
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}


$bom_FName = validate($_POST['bom_FName']);
$bom_LName = validate($_POST['bom_LName']);

$bom_email = validate($_POST['bom_email']);
$position = validate($_POST['position']);

$uname= validate($_POST['uname']);
$psw= validate($_POST['psw']);

$teacher = $_POST['teacher_bom_id'];

$user_data = '';
$_SESSION['details'] = $teacher;
$_SESSION['data'] = 'refresh';
if (empty($teacher)) {
    $_SESSION['error'] = "Admin id is required";
    header("Location: admin.php");
    exit();
}else if(empty($bom_FName)){
    $_SESSION['error'] = "Bom First Name is required";
    header("Location: admin.php");
    exit();
}
else if(empty($bom_LName)){
    $_SESSION['error'] = "Bom Last Name is required";
    header("Location: admin.php");
    exit();
}
else if(empty($bom_email)){
    $_SESSION['error'] = "Bom email is required";
    header("Location: admin.php");
    exit();
}
else if(empty($position)){
    $_SESSION['error'] = "Bom position is required";
    header("Location: admin.php");
    exit();
}
else if(empty($uname)){
    $_SESSION['error'] = "Bom username is required";
    header("Location: admin.php");
    exit();
}
else if(empty($psw)){
    $_SESSION['error'] = "Bom position is required";
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

            $query2 = "INSERT INTO bom(first_name, last_name ,email,role,position,username,password) 
            VALUES('$bom_FName', '$bom_LName', '$bom_email','BOM','$position','$uname','$psw')";
            $result2 = mysqli_query($con, $query2);
            if ($result2) {
                $_SESSION['success'] = "BOM has been created successfully";
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