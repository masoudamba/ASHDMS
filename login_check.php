<?php 

session_start();

	include("Mydb.php");
	
    $_SESSION['data']='refresh';
    $_SESSION['success']='No Error';
    $_SESSION['error']='No Error';

    if (isset($_POST['uname']) && isset($_POST['psw']) && isset($_POST['role'])) {

        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
         $uname = validate($_POST['uname']);
        $psw = validate($_POST['psw']);
        $role = validate($_POST['role']);

        
        if (empty($uname)) {
            header("Location: login.php?error=User Name is required");
            
        }elseif(empty($psw)){
            header("Location: login.php?error=Password is required");
            
        }else{
            $psw = md5($psw);
             
            $query = "SELECT * FROM teachers WHERE username='$uname' AND password='$psw'";

            if('Parent'===$role){
                $query = "SELECT * FROM parents WHERE username='$uname' AND password='$psw'";
            }else if('Committee'===$role){
                $query = "SELECT * FROM committee WHERE username='$uname' AND password='$psw'";
            }else if('BOM'===$role){
                $query = "SELECT * FROM bom WHERE username='$uname' AND password='$psw'";
            }

            $result = mysqli_query($con, $query);

            
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if ($row['password'] === $psw) {
                   
                    if($row['role'] != $role){
                        if($role === 'Admin'){
                            header("Location: login.php?error=You are not an Admin!");
                        }
                      
                    }else{
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['role'] = $row['role'];
                        $_SESSION['uname'] = $row['username'];

                        $idd = $row['id'];
                        $row_encoded = json_encode($row);
                        if($row['role'] === 'Teacher'){
                            $_SESSION['details']=$idd;
                            header("Location: teacher.php");
                        }else if($row['role']==='Admin'){
                            $_SESSION['details']=$idd;
                            header("Location: admin.php");
                        }else if($row['role']==='BOM'){
                            $_SESSION['details']=$idd;
                            header("Location: BOM.php");
                        }else if($row['role']==='Committee'){
                            $_SESSION['details']=$idd;
                            header("Location: committee.php");
                        }else{
                            header("Location: parent.php");
                        }

                    }

                }else{
                    header("Location: login.php?error=Incorect User name or password");
                }
                    
            }else{
                header("Location: login.php?error=Incorect User name or password");
            }    
                    
        }

    }else{
        header("location:login.php");
    }
?>
