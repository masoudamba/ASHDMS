<?php 
session_start();

	include("config.php");
    include("function.php");
    
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


//$user_data = 'details='. $teacher. '&parentid='. $parent;
$user_data = 'details='. $teacher;
if (empty($teacher)) {
    header("Location: teacher.php?error=Teacher id is required&$user_data");
    exit();
}else if(empty($student)){
    header("Location: teacher.php?error=Student Reg id is required&$user_data");
    exit();
}
else if(empty($action)){
    header("Location: teacher.php?error=Action Taken is required&$user_data");
    exit();
}
else if(empty($penalty)){
    header("Location: teacher.php?error=Penalty is required&$user_data");
    exit();
}
else if(empty($infraction)){
    header("Location: teacher.php?error=Infraction is required&$user_data");
    exit();
}
else{

    
    $query = "SELECT * FROM  users WHERE id='$teacher' ";
    $result = mysqli_query($con, $query);

    
    if (mysqli_num_rows($result) < 1) {
        header("Location: teacher.php?error=Teacher not found&$user_data");
        exit();
    }else {

        $queryParent = "SELECT * FROM  users WHERE ref_student_reg='$student' ";
        $resultParent = mysqli_query($con, $queryParent);

        if (mysqli_num_rows($resultParent) < 1) {
            header("Location: teacher.php?error=Parent not found&$user_data");
            exit();
        }else{

            try {
                $parentDetail = mysqli_fetch_assoc($resultParent);
                $parent = $parentDetail['id'];

                $query2 = "INSERT INTO cases(parent_id, teacher_id ,status,infraction,penalty,action) 
                VALUES('$parent', '$teacher', 'Pending','$infraction', '$penalty','$action')";
                $result2 = mysqli_query($con, $query2);
                if ($result2) {
                    header("Location: teacher.php?success=Your case has been created successfully&$user_data");
                    exit();
                }else {
                    header("Location: teacher.php?error=unknown error occurred&$user_data");
                    exit();
                }
            } catch (\Throwable $th) {
                //throw $th;
                header("Location: teacher.php?error=unknown error occurred&$user_data");
                exit();
            }
            

        }

       
    }
}
	
}else{
	header("Location: teacher.php&$user_data");
	exit();
}
?>