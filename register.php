<?php

include("Mydb.php");


$error = "No Error";

 $sql_cases = "SELECT * FROM students";

 $sql_parent = "SELECT * FROM parents";


 $qry1 = mysqli_query($con, $sql_cases);
 $qryProfile = mysqli_query($con, $sql_cases);
 $index_cases = 0;
 $index = 0;
 $index_cases_new = 0;
 $options_profiles = array();
 $val_profiles;
 $options = array();


$validExecute = false;

$option_parents = array();
$indexParent = 0;

try {
  $qryParents = mysqli_query($con, $sql_parent);
  if((mysqli_num_rows($qryParents)) > 0){

    while($tichaP = mysqli_fetch_assoc($qryParents)){
      $option_parents[$indexParent] = $tichaP;
      $indexParent = $indexParent+1;
    }
  }
  
} catch (\Throwable $th) {
  //throw $th;
}

//get students details
try {
    //code...
    if((mysqli_num_rows($qry1)) > 0){
      $validExecute = true;

      while($ticha = mysqli_fetch_assoc($qry1)){

        $studentAbsent = true;
        try {

          foreach($option_parents as $theParent){

            if($theParent['student_reg_no']===$ticha['regNo']){
              $studentAbsent = false;
              break;
            }else if($theParent['student_reg_no2']===$ticha['regNo']){
                $studentAbsent = false;
                break;
            }else{
              continue;
            }
          }
          
        } catch (\Throwable $th) {
          //throw $th;
        }

        if($studentAbsent){
          $options[$index] = $ticha;
          $index = $index+1;
        }
        
      }
    }
 } catch (\Throwable $th) {
   
 }

 if(isset($_GET['error'])){
    $error = $_GET['error'];
 }
 
 if(isset($_GET['success'])){
    $error = $_GET['success'];
 }

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, intial-scale=1.0">
<title>ASH Discipline Monitoring System</title>
<script type = "text/javascript">  
         function msgprint() {  
            alert("You are Successfully Called the JavaScript function");  
         }
         
         function showStudentDiv(){
            var e = document.getElementById("role_dropdown");
            var g = document.getElementById("ref_student_reg");
            var strUser = e.options[e.selectedIndex].text;

            if("Parent"===strUser){
                g.style.display = "block";
            }else{
                g.style.display = "none";
            }
         }

         function schedule(selectedValue){
            var g = document.getElementById("ref_student_reg");
            var y = document.getElementById("ref_student_reg2");
            if("Parent"===selectedValue){
                g.style.display = "block";
                y.style.display = "block";
            }else{
                g.style.display = "none";
                y.style.display = "none";
            }
        
        }

        function addStudentsToOptions(studentData,errorCode){

          try {


           
            var element3 = document.createElement("select");
            var g = document.getElementById("ref_reg_select_one");
            var y = document.getElementById("ref_reg_select_two");
            var student_re = 0;

            var optionDefault1 = document.createElement("option");
            var optionDefault2 = document.createElement("option");
            optionDefault1.value = student_re;
            optionDefault1.label = student_re;

            optionDefault2.value = student_re;
            optionDefault2.label = student_re;

            g.appendChild(optionDefault1);
            y.appendChild(optionDefault2);



            studentData.forEach(student => {
              var student_reg = student['regNo'];
              var option = document.createElement("option");
              var option2 = document.createElement("option");
              option.value = student_reg;
              option.label = student_reg;

              option2.value = student_reg;
              option2.label = student_reg;

              g.appendChild(option);
              y.appendChild(option2);
            });
          } catch (error) {
            console.log(error);
          }

        }



</script>  
<link rel="stylesheet" href="css/123.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
 rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

<!--fav-icon-->
<link rel="shortcut icon" href="images/download.png"/>


	<style>
	    /* Full-width input fields */
input[type=text], input[type=password],input[type=phone],input[type=email]{
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}
/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
  justify-content: center;
}
/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
  background-color:#006666;
}
span.psw {
  float: center;
  padding-top: 10px;
}
/* The Modal (background) */
.modal {
  display: flex; /* Hidden by default */
  position: absolute; 
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  justify-content: center;
  padding-top: 0px;
}

/* Modal Content/Box */
.modal-content {
    width: 400px;
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}
	</style>
    </head>
    <body>
    <section class="main" style="background-image: url(images/slider2.jpg);">
        
        <nav>
            <a href="#" class="logo">
                <img src="images/logo.jpg" width="84px"/>
            </a>
            <input class="menu-btn" type="checkbox" id="menu-btn"/>
            <label class="menu-icon" for="menu-btn">
                <span class="nav-icon"></span>
            </label>
    </section>

    <div class="cases">
            
        <?php 
            //mysqli_num_rows($qry1) >= 1
            $vExecute = $validExecute;
            if ($vExecute){
                $valEcho;
                //$tichaId = $teacherID;
                $errorId = $error;
                //$options = array();
                $index = 0;
                //$ticha;

                //$val_profiles = array();
                //$val_profiles = json_encode($options_profiles);

                $valEcho = json_encode($options);

                //$val_profiles = json_encode($options_profiles);

                try {
                    //code...
                    echo "<br></br><br></br>";
                    
                    if($valEcho){
                        //$val_echo_string."populateTableCases($valEcho);";

                        echo "<script type='text/javascript'> window.onload = function(){
                          addStudentsToOptions($valEcho,'$errorId');
                        };  </script>";
                    }
                } catch (Throwable $th) {
                    //throw $th;
                }

                
             }
        ?>
    </div>

	
    <!-- register modal start -->
    <div class = "modal">
      
        <form  action="register_check.php" method="post"style="
            width: 400px;
        ">
              <div class="imgcontainer">
                
                <p style="font-size: 30px;">Fill up the form based on role: </p>
            
              </div>
    <div class="container">
    <label for="firstname"><b>First Name</b></label>
    <input type ="text" placeholder="firstname" name="firstname" required>

    <label for="lastname"><b>Last Name</b></label>
    <input type="text" placeholder="lastname" name="lastname" required>
    <div class="mb-1">
    <label for="role"><b>Role</b></label>
    
    <select onchange="schedule(this.value)" class="form-select mb-3="
                name="role"
                arial-label="Default select example">
                    
                     <option value="Teacher">Teacher</option>
                     <option value="Parent">Parent</option>
    </select>
    </div>
    
    <div style="display:none;" id="ref_student_reg" class="mb-1">
        <label for="studentre"><b>Student Reg. No.</b></label>
            <select id="ref_reg_select_one" class="form-select mb-3="
                name="studentre"
                arial-label="Default select example">
            </select>

    </div>
    
    <div style="display:none;" id="ref_student_reg2" class="mb-1">
        <label for="studentre2"><b>Student Reg. No. 2</b></label>
          <select id="ref_reg_select_two" class="form-select mb-3="
                name="studentre2"
                arial-label="Default select example">
          </select>
        
    </div>
         
    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="name@gmail.com" name="email">

    <label for="phone"><b>Phone Number</b></label>
    <input type="phone" placeholder="Enter phone" name="phone" required>

    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="At least 8 characters" name="psw" required>
        
    <label for="pswC"><b>Confirm Password</b></label>
    <input type="password" placeholder="Confirm Password" name="pswC" required>
    
    <button type="submit" >Register</button>
    
        <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
              </div>
          
              <div class="container" style="background-color:#f1f1f1">
              <a href="index.php"><button type="button" onclick="document.getElementById('id01').style.display='none'" 
                class="cancelbtn">Cancel</button></a>
                <span class="psw" style="margin-right: 11px;"><a href="#">Already have Account?</a></span>
                <span class="psw"><a href="login.php">Login Here</a></span>
              </div>
  </div>
</div>
</div>
</form>
</div>
 <!-- register modal end  -->
     <!--footer------------->
     <footer>
      <div class="copywrite-area">
        <div class="container">
          <div class="copywrite-text">
            <div class="row align-items-center">
              <div class="col-md-6">
                <small>
                    Copyright &copy;
                    <script>document.write(new Date().getFullYear());</script>
                    All rights reserved AgoroSare
                </small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

</body>
</html>