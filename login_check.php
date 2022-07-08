<?php 

session_start();

	include("config.php");
	//include("function.php");


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
             
            $query = "SELECT * FROM users WHERE user_name='$uname' AND password='$psw'";
            $result = mysqli_query($con, $query);

            
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if ($row['password'] === $psw) {
                    //$row['password'] === $psw && $row['role'] === $role
                    if($row['role'] != $role){
                        if($role === 'Admin'){
                            header("Location: login.php?error=You are not an Admin!");
                        }
                        //echo 'Role not matching!';
                    }else{
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['role'] = $row['role'];
                        $_SESSION['uname'] = $row['uname'];

                        $idd = $row['id'];
                        $row_encoded = json_encode($row);
                        if($row['role'] === 'Teacher'){
                            header("Location: teacher.php?details='$idd'");
                        }else if($row['role']==='Admin'){
                            header("Location: admin.php?details=$row_encoded");
                        }else{
                            header("Location: parent.php?details='$idd'");
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
