<?php 
session_start();

	include("Mydb.php");
    include("function.php");
    
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

$user_data = 'details='. $teacher;
if (empty($teacher)) {
    header("Location: admin.php?error=Admin id is required&$user_data");
    exit();
}else if(empty($bom_FName)){
    header("Location: admin.php?error=Bom First Name is required&$user_data");
    exit();
}
else if(empty($bom_LName)){
    header("Location: admin.php?error=Bom Last Name is required&$user_data");
    exit();
}
else if(empty($bom_email)){
    header("Location: admin.php?error=Bom email is required&$user_data");
    exit();
}
else if(empty($position)){
    header("Location: admin.php?error=Bom position is required&$user_data");
    exit();
}
else if(empty($uname)){
    header("Location: admin.php?error=Bom username is required&$user_data");
    exit();
}
else if(empty($psw)){
    header("Location: admin.php?error=password position is required&$user_data");
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

            $query2 = "INSERT INTO bom(first_name, last_name ,email,role,position,username,password) 
            VALUES('$bom_FName', '$bom_LName', '$bom_email','BOM','$position','$uname','$psw')";
            $result2 = mysqli_query($con, $query2);
            if ($result2) {
                header("Location: admin.php?success=BOM has been created successfully&$user_data");
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