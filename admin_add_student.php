<?php 
session_start();

	include("Mydb.php");
    include("function.php");
    
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

$user_data = 'details='. $teacher;
if (empty($teacher)) {
    header("Location: admin.php?error=Admin id is required&$user_data");
    exit();
}else if(empty($regNo)){
    header("Location: admin.php?error=Student Reg No is required&$user_data");
    exit();
}
else if(empty($student_fName)){
    header("Location: admin.php?error=Student First Name is required&$user_data");
    exit();
}
else if(empty($student_lName)){
    header("Location: admin.php?error=Student Last Name is required&$user_data");
    exit();
}
else if(empty($student_form)){
    header("Location: admin.php?error=student form is required&$user_data");
    exit();
}
else{

    
    $query = "SELECT * FROM  teachers WHERE id='$teacher' ";
    $result = mysqli_query($con, $query);

    
    if (mysqli_num_rows($result) < 1) {
        header("Location: admin.php?error=Admin not found&$user_data");
        exit();
    }else {

        try {

            $query2 = "INSERT INTO students(first_name, last_name ,Form,regNo) 
            VALUES('$student_fName', '$student_lName', '$student_form','$regNo')";
            $result2 = mysqli_query($con, $query2);
            if ($result2) {
                header("Location: admin.php?success=Student has been created successfully&$user_data");
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