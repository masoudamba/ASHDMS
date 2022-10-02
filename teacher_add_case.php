<?php 
session_start();

	include("Mydb.php");
    
if (isset($_POST['teacher']) && isset($_POST['student'])
&& isset($_POST['penalty']) && isset($_POST['action']) && isset($_POST['infraction'])) {

function validate($data){
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}


$teacher = validate($_POST['teacher']);
$student = validate($_POST['student']);

$penalty = validate($_POST['penalty']);
$action = validate($_POST['action']);

$infraction = validate($_POST['infraction']);



$user_data = '';
$_SESSION['details'] = $teacher;
$_SESSION['data'] = 'refresh';
if (empty($teacher)) {
    $_SESSION['error'] = "Teacher id is required";
    header("Location: teacher.php");
    exit();
}else if(empty($student)){
    $_SESSION['error'] = "Student Reg is required";
    header("Location: teacher.php");
    exit();
}
else if(empty($action)){
    $_SESSION['error'] = "Action Taken s required";
    header("Location: teacher.php");
    exit();
}
else if(empty($penalty)){
    $_SESSION['error'] = "Penalty is required";
    header("Location: teacher.php");
    exit();
}
else if(empty($infraction)){
    $_SESSION['error'] = "Infraction  is required";
    header("Location: teacher.php");
    exit();
}
else{

    
    $query = "SELECT * FROM  teachers WHERE id='$teacher' ";
    $result = mysqli_query($con, $query);

    
    if (mysqli_num_rows($result) < 1) {
        $_SESSION['error'] = "Teacher not found";
        header("Location: teacher.php");
        exit();
    }else {

        $queryParent = "SELECT * FROM  parents WHERE student_reg_no='$student' ";
        $resultParent = mysqli_query($con, $queryParent);

        $isStudentValid = false;

        if (mysqli_num_rows($resultParent) < 1) {

            $queryParent2 = "SELECT * FROM  parents WHERE student_reg_no2='$student' ";
            $resultParent2 = mysqli_query($con, $queryParent2);

            if(mysqli_num_rows($resultParent2) < 1){
                $_SESSION['error'] = "Parent not found";
                header("Location: teacher.php");
                exit();
            }else{
                $resultParent = $resultParent2;
                $isStudentValid = true;
            }
        }else{
            $isStudentValid = true;
        }


        if ($isStudentValid) {
            try {
                $parentDetail = mysqli_fetch_assoc($resultParent);
                $parent = $parentDetail['id'];

                $query2 = "INSERT INTO cases(parent_id, teacher_id ,status,infraction,penalty,action,verdict,link,date) 
                VALUES('$parent', '$teacher', 'Pending','$infraction', '$penalty','$action','Pending','Pending','Pending')";
                $result2 = mysqli_query($con, $query2);
                if ($result2) {
                    $_SESSION['error'] = "Your case has been reported successfully";
                    header("Location: teacher.php");
                    exit();
                }else {
                    $_SESSION['error'] = "unknown error occurred";
                    header("Location: teacher.php");
                    exit();
                }
            } catch (\Throwable $th) {
                //throw $th;
                $_SESSION['error'] = "unknown error occurred";
                header("Location: teacher.php");
                exit();
            }
        }else{
            $_SESSION['error'] = "Parent not found";
            header("Location: teacher.php");
            exit();
        }

       
    }
}
	
}else{
    $_SESSION['error'] = "unknown error occurred";
    header("Location: teacher.php");
	exit();
}
?>