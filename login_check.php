<?php 

session_start();

	include("config.php");
	include("function.php");


    if (isset($_POST['uname']) && isset($_POST['psw'])) {

        function validate($data){
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
        }
    
        $uname = validate($_POST['uname']);
        $psw = validate($_POST['psw']);
    
        if (empty($uname)) {
            header("Location: login.php?error=User Name is required");
            exit();
        }else if(empty($pass)){
            header("Location: login.php?error=Password is required");
            exit();
        }else{
            // hashing the password
            $pass = md5($psw);
    
            
            $query = "SELECT * FROM staff WHERE user_name='$uname' AND password='$psw'";
    
            $result = mysqli_query($con, $query);
    
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if ($row['user_name'] === $uname && $row['password'] === $psw) {
                    $_SESSION['user_name'] = $row['user_name'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                    header("Location: welcome.php");
                    exit();
                }else{
                    header("Location: login.php?error=Incorect User name or password");
                    exit();
                }
            }else{
                header("Location: login.php?error=Incorect User name or password");
                exit();
            }
        }
        
    }else{
        header("Location: login.php");
        exit();
    }
?>