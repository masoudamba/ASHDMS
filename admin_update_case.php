<?php 
session_start();

	include("Mydb.php");
    
if (isset($_POST['admin_id']) && isset($_POST['case_id']) && isset($_POST['teacher']) && isset($_POST['date'])
&& isset($_POST['parent']) && isset($_POST['infraction']) && isset($_POST['penalty']) 
&& isset($_POST['status']) && isset($_POST['verdict']) && isset($_POST['link'])
&& isset($_POST['action'])) {

function validate($data){
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

$admin_id = validate($_POST['admin_id']);

$case_id = validate($_POST['case_id']);
$teacher = validate($_POST['teacher']);

$date = validate($_POST['date']);
$parent = validate($_POST['parent']);
$infraction = validate($_POST['infraction']);
$penalty = validate($_POST['penalty']);
$status = validate($_POST['status']);

$verdict = validate($_POST['verdict']);
$link = $_POST['link'];
$action = validate($_POST['action']);


$user_data = '';
$_SESSION['details'] = $teacher;
$_SESSION['data'] = 'refresh';
if (empty($admin_id)) {
    $_SESSION['error'] = "Admin ID is required";
    header("Location: admin.php");
    exit();
}
else if(empty($action)){
    $_SESSION['error'] = "Action is required";
    header("Location: admin.php");
    exit();
}else if(empty($verdict)){
    $_SESSION['error'] = "verdict is required";
    header("Location: admin.php");
    exit();
}

else if(empty($link)){
    $_SESSION['error'] = "link is required";
    header("Location: admin.php");
    exit();
}else if(empty($case_id)){
    $_SESSION['error'] = "Case ID is required";
    header("Location: admin.php");
    exit();
}
else if(empty($teacher)){
    $_SESSION['error'] = "Teacher ID is required";
    header("Location: admin.php");
    exit();
}
else if(empty($date)){
    $_SESSION['error'] = "Date is required";
    header("Location: admin.php");
    exit();
}
else if(empty($parent)){
    $_SESSION['error'] = "Parent id is required";
    header("Location: admin.php");
    exit();
}
else if(empty($infraction)){
    $_SESSION['error'] = "Infraction is required";
    header("Location: admin.php");
    exit();
}

else if(empty($penalty)){
    $_SESSION['error'] = "Penalty is required";
    header("Location: admin.php");
    exit();
}
else{

    $table_focus = "teachers";

    
    $query = "SELECT * FROM $table_focus WHERE id='$admin_id' ";
    $result = mysqli_query($con, $query);

    $query3 = "SELECT * FROM cases WHERE id='$case_id' ";
    $result3 = mysqli_query($con, $query3);

  

    if (mysqli_num_rows($result) > 0) {
        
        if(mysqli_num_rows($result3) > 0){


            $query2 = "UPDATE cases 
                SET parent_id = '$parent', teacher_id = '$teacher', status='$status',
                infraction = '$infraction',penalty = '$penalty',action = '$action',
                verdict = '$verdict',link = '$link',date = '$date' WHERE id = '$case_id'";

            $result2 = mysqli_query($con, $query2);

            if ($result2) {
                $_SESSION['error'] = "Case Updated successfully";
                header("Location: admin.php");
                exit();
            }else {
                $_SESSION['error'] = "unknown error occurred";
                header("Location: admin.php");
                exit();
            }

        }else{
            $_SESSION['error'] = "No such case found";
            header("Location: admin.php");
            exit();
        }

        
       
       

    }else {
        header("Location: admin.php?error=The Admin ID is Incorrect&$user_data");
        exit();
        
    }
}
	
}else{

    $admin_id = 0;
    try {
        //code...
        $admin_id = $_POST['admin_id'];

        if($admin_id>0){
            $user_data = 'details='. $admin_id;
            header("Location: admin.php?error=The Admin ID is Incorrect&$user_data");
	        exit();
        }else{
            header("Location: login.php");
	        exit();
        }
    } catch (\Throwable $th) {
        //throw $th;
        header("Location: login.php");
	    exit();
    }
    
	
}
?>