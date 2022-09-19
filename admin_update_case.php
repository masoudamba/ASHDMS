<?php 
session_start();

	include("Mydb.php");
    include("function.php");
    
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


$user_data = 'details='. $admin_id;
if (empty($admin_id)) {
    header("Location: admin.php?error=Admin ID is required&$user_data");
    exit();
}
else if(empty($action)){
    header("Location: admin.php?error=action is required&$user_data");
    exit();
}else if(empty($verdict)){
    header("Location: admin.php?error=verdict is required&$user_data");
    exit();
}

else if(empty($link)){
    header("Location: admin.php?error=link is required&$user_data");
    exit();
}else if(empty($case_id)){
    header("Location: admin.php?error=Case ID is required&$user_data");
    exit();
}
else if(empty($teacher)){
    header("Location: admin.php?error=Teacher ID is required&$user_data");
    exit();
}
else if(empty($date)){
    header("Location: admin.php?error=Date is required&$user_data");
    exit();
}
else if(empty($parent)){
    header("Location: admin.php?error=parent id is required&$user_data");
    exit();
}
else if(empty($infraction)){
    header("Location: admin.php?error=Infraction is required&$user_data");
    exit();
}

else if(empty($penalty)){
    header("Location: admin.php?error=penalty is required&$user_data");
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
                header("Location: admin.php?error=Case Updated successfully&$user_data");
                exit();
            }else {
                header("Location: admin.php?error=unknown error occurred&$user_data");
                exit();
            }

        }else{
            header("Location: admin.php?error=No such case found&$user_data");
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