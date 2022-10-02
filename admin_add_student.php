<?php 
session_start();

	include("Mydb.php");
    
if (isset($_POST['regNo']) && isset($_POST['student_FName'])
&& isset($_POST['student_LName']) && isset($_POST['student_form'])) {

function validate($data){
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}


$regNo = validate($_POST['regNo']);
$student_fName = validate($_POST['student_FName']);

$student_lName = validate($_POST['student_LName']);
$student_form = validate($_POST['student_form']);

$teacher = $_POST['teacher'];

$user_data = '';
$_SESSION['details'] = $teacher;
$_SESSION['data'] = 'refresh';
if (empty($teacher)) {
    $_SESSION['error'] = "Admin id is required";
    header("Location: admin.php");
    exit();
}else if(empty($regNo)){
    $_SESSION['error'] = "Student Reg No is required";
    header("Location: admin.php");
    exit();
}
else if(empty($student_fName)){
    $_SESSION['error'] = "Student First Name is required";
    header("Location: admin.php");
    exit();
}
else if(empty($student_lName)){
    $_SESSION['error'] = "Student Last Name is required";
    header("Location: admin.php");
    exit();
}
else if(empty($student_form)){
    $_SESSION['error'] = "Student form is required";
    header("Location: admin.php");
    exit();
}
else{

    
    $query = "SELECT * FROM  teachers WHERE id='$teacher' ";
    $result = mysqli_query($con, $query);

    
    if (mysqli_num_rows($result) < 1) {
        $_SESSION['error'] = "Admin not found";
        header("Location: admin.php");
        exit();
    }else {

        try {

            $query2 = "INSERT INTO students(first_name, last_name ,Form,regNo) 
            VALUES('$student_fName', '$student_lName', '$student_form','$regNo')";
            $result2 = mysqli_query($con, $query2);
            if ($result2) {
                $_SESSION['error'] = "Student has been created successfully";
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