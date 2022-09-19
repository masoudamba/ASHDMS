<?php 
session_start();

	include("Mydb.php");
    include("function.php");
    
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

$user_data = 'details='. $teacher;
if (empty($teacher)) {
    header("Location: admin.php?error=Admin id is required&$user_data");
    exit();
}else if(empty($com_FName)){
    header("Location: admin.php?error=Committee First Name is required&$user_data");
    exit();
}
else if(empty($com_LName)){
    header("Location: admin.php?error=Committee Last Name is required&$user_data");
    exit();
}
else if(empty($com_email)){
    header("Location: admin.php?error=Committee email is required&$user_data");
    exit();
}
else if(empty($position)){
    header("Location: admin.php?error=Committee position is required&$user_data");
    exit();
}
else if(empty($uname)){
    header("Location: admin.php?error=Committee username is required&$user_data");
    exit();
}
else if(empty($psw)){
    header("Location: admin.php?error=password  required&$user_data");
    exit();
}

else{

    
    $query = "SELECT * FROM  teachers WHERE id='$teacher' ";
    $result = mysqli_query($con, $query);
    $psw = md5($psw);

    
    if (mysqli_num_rows($result) < 1) {
        header("Location: admin.php?error=Admin not found&$user_data");
        exit();
    }else {

        try {

            $query2 = "INSERT INTO committee(first_name, last_name ,email,role,position,username,password) 
            VALUES('$com_FName', '$com_LName', '$com_email','Committee','$position','$uname','$psw')";
            $result2 = mysqli_query($con, $query2);
            if ($result2) {
                header("Location: admin.php?success=New committee has been created successfully&$user_data");
                exit();
            }else {
                header("Location: admin.php?error=unknown error occurred&$user_data");
                exit();
            }
        } catch (\Throwable $th) {
            
            header("Location: admin.php?error=unknown error occurred&$user_data");
            exit();
        }

       
    }
}
	
}else{
	header("Location: admin.php&$user_data");
	exit();
}
?>