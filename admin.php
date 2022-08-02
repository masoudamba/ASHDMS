<?php

include("config.php");
include("function.php");

$roww = $_GET['details'];
$error = "No Error";

$teacherID = $roww;

 //$sql_cases = "SELECT * FROM cases WHERE teacher_id = $teacherID";
 $sql_cases = "SELECT * FROM cases";
 //$sql_john = "SELECT * FROM persons WHERE forename = 'john'";

 $sql_students = "SELECT * FROM students";

 $sql_teachers = "SELECT * FROM teachers";

 $sql_parents = "SELECT * FROM parents";

 //sort teachers
 $indexTeachers = 0;
 $qryTeachers;
 $val_teachers;
 $options_teachers = array();

 try {
    //code...
    $qryTeachers = mysqli_query($con, $sql_teachers);   
   
   while($tichaTeacher = mysqli_fetch_assoc($qryTeachers)){
       //$valEcho = json_encode($ticha);
       $options_teachers[$indexTeachers] = $tichaTeacher;
       $indexTeachers = $indexTeachers+1;
       
   }
 } catch (\Throwable $th) {
    //throw $th;
 }

 //sort parents
 $indexParent = 0;
 $qryParents;
 $val_parents;
 $options_parents = array();

 try {
    //code...
    $qryParents = mysqli_query($con, $sql_parents);   
   
   while($tichaParent = mysqli_fetch_assoc($qryParents)){
       //$valEcho = json_encode($ticha);
       $options_parents[$indexParent] = $tichaParent;
       $indexParent = $indexParent+1;
       
   }
 } catch (\Throwable $th) {
    //throw $th;
 }

 //sort students
 $indexStudent = 0;
 $qryStudents;
 $val_students;
 $options_students = array();

 
 try {
    //code...
    $qryStudents = mysqli_query($con, $sql_students);   
   
   while($tichaStudent = mysqli_fetch_assoc($qryStudents)){
       //$valEcho = json_encode($ticha);
       $options_students[$indexStudent] = $tichaStudent;
       $indexStudent = $indexStudent+1;
       
   }
 } catch (\Throwable $th) {
    //throw $th;
 }

 $qry1;
 $qryProfile;
 $index_cases = 0;
 $index = 0;
 $options_profiles = array();
 $val_profiles;
 $options = array();

 //sort cases
 try {
    //code...
    $qry1 = mysqli_query($con, $sql_cases);
    $qryProfile = mysqli_query($con, $sql_cases);
    
   
   
   
   while($ticha = mysqli_fetch_assoc($qry1)){
       //$valEcho = json_encode($ticha);
       $options[$index] = $ticha;
       $index = $index+1;
       
   }
 } catch (\Throwable $th) {
    //throw $th;
 }


//sort student profiles
 try {
    //code...
    if((mysqli_num_rows($qryProfile)) > 0){

        while($ticha_profile = mysqli_fetch_assoc($qryProfile)){
            //$valEcho = json_encode($ticha);
    
            $parent_name = " No name";
            $student_reg = "No reg";
            $student_name = "No name";
            $form=1;
            $case_id;
            $infraction_item;
            $status;
    
            try {
                //code...
    
                $case_id = $ticha_profile['id'];
                $infraction_item = $ticha_profile['infraction'];
                $status = $ticha_profile['status'];
    
            } catch (\Throwable $th) {
                //throw $th;
            }
    
            $p_id = $ticha_profile['parent_id'];
            $sql_parent_id = "SELECT * FROM users WHERE id = $p_id";
            $qryParentId = mysqli_query($con, $sql_parent_id);
    
            try {
                //code...
                while ($p_assoc = mysqli_fetch_assoc($qryParentId)) {
                    # code...
                    if($p_id===$p_assoc['id']){
                        $student_reg = $p_assoc['ref_student_reg'];
                        $parent_name = $p_assoc['first_name']." ".$p_assoc['last_name'];
                        
                    }
                    
                }
                
                
            } catch (\Throwable $th) {
                //throw $th;
    
            }
    
            try {
                //code...
                $sql_student_id = "SELECT * FROM students WHERE regNo = '$student_reg'";
                $qryStudentId = mysqli_query($con, $sql_student_id);
    
                while ($s_assoc = mysqli_fetch_assoc($qryStudentId)) {
                    # code...
                    if($student_reg===$s_assoc['regNo']){
                        $student_name = $s_assoc['first_name']." ".$s_assoc['last_name'];
                        $form = $s_assoc['Form'];
                    }
                }
                
    
            } catch (\Throwable $th) {
                //throw $th;
            }
    
    
            if("No name"!==$student_name){
                $new_array = array(
                    "student_reg"=>$student_reg,
                    "student_name"=>$student_name,
                    "form"=>$form,
                    "case_id"=>$case_id,
                    "parent_name"=>$parent_name,
                    "infraction"=>$infraction_item,
                    "status"=>$status
                );
        
                $options_profiles[$index_cases] = $new_array;
                $index_cases = $index_cases+1;
            }
            
            
        }

        //$val_profiles = json_encode($options_profiles);
     }
 } catch (\Throwable $th) {
    //throw $th;
 }


 
 
 //$qry1 = $con->query($sql_cases);

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
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* This style new case form */
/* Full-width input fields */
input[type=text], input[type=password],input[type=phone],input[type=action],input[type=email],input[type=number]{
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
  padding-top: 60px;
  font-size: 17px;
}


/* This end of the style of new case form */

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

	
</style>

<title>ASH Discipline Monitoring System</title>
<script>
    var ID_user = 0;
    var All_Parents;
    var All_Teachers;
    var All_Students;
    var All_Cases;

    function setAllData(parents,students,teachers,cases){
        //alert(id);
        try {
            All_Parents = parents;
            All_Teachers = teachers;
            All_Students = students;
            All_Cases = cases;
            
        } catch (error) {
            console.log(error);
        }

        try {
            populateStudentProfiles(students,"No Error")
        } catch (error) {
            //
            console.log(error);
        }
        
    }

    function setIDUser(id,students){
        //alert(id);
        try {
            ID_user = id;
        } catch (error) {
            console.log(error);
        }

        populateStudentsNewCase(students);
        
    }

    function populateStudentsNewCase(studentArray){

        try {
            
            //var element3 = document.createElement("select");
            var g = document.getElementById("student_reg_new_case");
            //var y = document.getElementById("ref_reg_select_two");
            var student_re = 0;

            var optionDefault1 = document.createElement("option");
            optionDefault1.value = student_re;
            optionDefault1.label = student_re;

            g.appendChild(optionDefault1);

            studentArray.forEach(student => {
              let student_reg = student['regNo'];
              let option = document.createElement("option");
              option.value = student_reg;
              option.label = student_reg;

              g.appendChild(option);
            });

        } catch (error) {
            console.log(error);
        }

    }

    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }

    function addRow(tableID) {  
        var table = document.getElementById(tableID);  
        var rowCount = table.rows.length;  
        var row = table.insertRow(rowCount);  
        rowCount = rowCount-1;

        try{
            var rowCounttt = table.rows.length - 1; 
            var x = table.rows[rowCounttt].cells[0].value;
            rowCount = x; 
        }catch(e){
            //alert(e);
        }
          
        //Column 1    
        var cell2 = row.insertCell(0);  
        cell2.innerHTML = rowCount + 1;  
        //Column 2  
        var cell3 = row.insertCell(1);  
        var element3 = document.createElement("input");  
        element3.type = "text"; 
        element3.setAttribute('disabled',true); 
        cell3.appendChild(element3);

        //Column 3  
        var cell3 = row.insertCell(2);  
        var element3 = document.createElement("input");  
        element3.type = "text";  
        element3.setAttribute('disabled',true); 
        cell3.appendChild(element3);
        //Column 4  
        var cell3 = row.insertCell(3);  
        var element3 = document.createElement("input");  
        element3.type = "text";
        element3.setAttribute('disabled',true);   
        cell3.appendChild(element3);
        

        
        if('student_profiles'===tableID){

            //Column 6  
            /*
            var cell3 = row.insertCell(5);  
            //var element3 = document.createElement("input");  
            //element3.type = "text";
            element3.setAttribute('disabled',true);   
            cell3.appendChild(element3);

            //Column 7 
            var cell3 = row.insertCell(6);  
            var element3 = document.createElement("input");  
            element3.type = "text";
            element3.setAttribute('disabled',true);   
            cell3.appendChild(element3);


            //Column 8 
            var cell3 = row.insertCell(7);  
            var element3 = document.createElement("select");

            var option1 = document.createElement("option");
            var option2 = document.createElement("option");
            var option3 = document.createElement("option");
            option1.value = "Pending";
            option2.value = "Completed";
            option3.value = "Active";

            option1.label = "Pending";
            option2.label = "Completed";
            option3.label = "Active";

            element3.class = "form-select";
            element3.appendChild(option1); 
            element3.appendChild(option2);
            element3.appendChild(option3);
            element3.setAttribute('disabled',true);
            cell3.appendChild(element3);*/

            //Column 5  
            var cell1 = row.insertCell(4);  
            var element1 = document.createElement("input");  
            element1.type = "button";  
            var btnName = "button" + (rowCount + 1);  
            element1.name = btnName;  
            element1.setAttribute('value', 'Student Details'); // or element1.value = "button";  
            element1.onclick = function () { editStudent(btnName); }  
            //element1.setAttribute('disabled',false);
            cell1.appendChild(element1);

            
            var element2 = document.createElement("input");  
            element2.type = "button";  
            var btnName = "button" + (rowCount + 1);  
            element2.name = btnName;  
            element2.setAttribute('value', ' '); // or element1.value = "button";  
            //.onclick = function () { confirmRow(btnName); }  
            element2.setAttribute('disabled',true);
            cell1.appendChild(element2);

        }else{

            //Column 5 
            var cell3 = row.insertCell(4);  
            var element3 = document.createElement("input");  
            element3.type = "text";
            element3.setAttribute('disabled',true);   
            cell3.appendChild(element3);

            //Column 6 
            var cell3 = row.insertCell(5);  
            var element3 = document.createElement("select");

            var option1 = document.createElement("option");
            var option2 = document.createElement("option");
            var option3 = document.createElement("option");
            option1.value = "Pending";
            option2.value = "Completed";
            option3.value = "Active";

            option1.label = "Pending";
            option2.label = "Completed";
            option3.label = "Active";

            element3.class = "form-select";
            element3.appendChild(option1); 
            element3.appendChild(option2);
            element3.appendChild(option3);
            element3.setAttribute('disabled',true);
            cell3.appendChild(element3);

            //Column 7  
            var cell1 = row.insertCell(6);  
            var element1 = document.createElement("input");  
            element1.type = "button";  
            var btnName = "button" + (rowCount + 1);  
            element1.name = btnName;  
            element1.setAttribute('value', 'Case Details'); // or element1.value = "button";  
            element1.onclick = function () { editRow(btnName); }  
            //element1.setAttribute('disabled',false);
            cell1.appendChild(element1);

            
            var element2 = document.createElement("input");  
            element2.type = "button";  
            var btnName = "button" + (rowCount + 1);  
            element2.name = btnName;  
            element2.setAttribute('value', ' '); // or element1.value = "button";  
            //.onclick = function () { confirmRow(btnName); }  
            element2.setAttribute('disabled',true);
            cell1.appendChild(element2);

        }


          
    }

    function setupErrorAndTeacherID(errorFromDB,teacherID){

        try {
            var teacher_id_el = document.getElementById('teacher_id_label'); 
            teacher_id_el.innerHTML=" ID : "+teacherID;

        } catch (error) {
            //
            alert(error);
        }

        try {

            if(errorFromDB!=="No Error"){
                alert(errorFromDB)
            }

        } catch (error) {
            //alert(error);
        }

    }

    function populateTableCases(rowdata_orig,errorFromDB,profiles,tichaa,students){
        ID_user = tichaa;

        var teacherID;

        try {
            //populateStudentProfiles(profiles,errorFromDB)
        } catch (error) {
            //
            console.log(error);
        }

        try {
            populateStudentsNewCase(students);
        } catch (error) {
            console.log(error);
        }

        try{

            //alert(rowdata);

            var table = document.getElementById('dataTable');  
            
            var ttt_id= "No id";

            rowdata_orig.forEach(rowdata => {
                var rowCount = table.rows.length;

                addRow('dataTable');

                var row = table.rows[rowCount];
                ttt_id = rowdata['teacher_id'];
                stateus = "null";
                for (let index = 1; index < 6; index++) {
                    if(index===1){
                        stateus = rowdata['id'];
                    }else if(index===2){
                        stateus = rowdata['parent_id'];
                    }else if(index===3){
                        stateus = rowdata['penalty'];
                    }else if(index===4){
                        stateus = rowdata['action'];
                    }else if(index===5){
                        stateus = rowdata['status'];

                        var strColor = "#999966";
                        if('Active'===stateus){
                            strColor = "#ff0000";
                        }else if('Completed'===stateus){
                            strColor = "#00ff00";
                        }

                        row.cells.item(index).style.backgroundColor = strColor;

                    }
                    //row.cells.item(index).firstChild.value=rowdata['status'];
                    row.cells.item(index).firstChild.value=stateus;
                }
 
            });

            try {
                    var ticha_ID_Element = document.getElementById('teacher_id_label');
                    //ticha_ID_Element.innerHTML=" ID : "+rowdata['teacher_id'];
                    ticha_ID_Element.innerHTML=" ID : "+ttt_id;
            } catch (error) {
                //
            }

            
         
        }catch(e){
            //
            alert(e);
        }

        try {

            if(errorFromDB!=="No Error"){
                alert(errorFromDB)
            }

        } catch (error) {
            //alert(error);
        }
    }

    function editRow(btnName) {  
        try {  
            var table = document.getElementById('dataTable');  
            var rowCount = table.rows.length;  
            for (var i = 0; i < rowCount; i++) {  
                var row = table.rows[i];
                
                var rowrowObj = row.cells.item(6).firstChild;
                var case_id = row.cells.item(1).firstChild.value;
                
                if (rowrowObj.name == btnName) {  

                    //table.deleteRow(i);  
                    //rowCount--;  
                    //showCaseOfId(case_id);
                    alert(case_id);
                    break;
                }  
            }
      
            
        }  
        catch (e) {  
            alert(e);  
        }  
    }

    function removeRow(btnName) {  
        try {  
            var table = document.getElementById('dataTable');  
            var rowCount = table.rows.length;  
            for (var i = 0; i < rowCount; i++) {  
                var row = table.rows[i];
                
                var rowrowObj = row.cells.item(6).firstChild;
                
                if (rowrowObj.name == btnName) {  
                    table.deleteRow(i);  
                    rowCount--;  
                }  
            }
      
            
        }  
        catch (e) {  
            alert(e);  
        }  
    }

    function showAddCase(selectedValue){

            var g = document.getElementById("form_new_case");
            var h = document.getElementById("the_cases");

            showStudentProfiles(false);

            try {
                if(selectedValue){
                    g.style.display = "block";
                    h.style.display = "none";

                    var t_id = document.getElementById("teacher_no");
                    t_id.value = ID_user;
                    //t_id.setAttribute('disabled',true);
                }else{
                    g.style.display = "none";
                    h.style.display = "block";
                }
            } catch (error) {
                alert(error);
            }
            
        
    }

    function showStudentProfiles(selectValue){

        try {
            
            var iProfile = document.getElementById("student_div");

            if(selectValue){
                
                iProfile.style.display = "block";

                var g = document.getElementById("form_new_case");
                var h = document.getElementById("the_cases");

                g.style.display = "none";
                h.style.display = "none";

                

            }else{
                iProfile.style.display = "none";
            }
        } catch (error) {
            //
        }

    }

    function populateStudentProfiles(rowdata_orig,errorFromDB){
        var teacherID;

        try{

            //alert(rowdata_orig);

            var table = document.getElementById('student_profiles');  
            
            var ttt_id= "No id";

            rowdata_orig.forEach(rowdata => {
                var rowCount = table.rows.length;

                addRow('student_profiles');

                var row = table.rows[rowCount];
                //ttt_id = rowdata['teacher_id'];
                stateus = "null";
                try {
                    for (let index = 1; index < 4; index++) {
                        if(index===1){
                            stateus = rowdata['regNo'];
                        }else if(index===2){
                            stateus = rowdata['first_name'] +" "+rowdata['last_name'];
                        }else if(index===3){
                            stateus = rowdata['Form'];
                        }   
                        //row.cells.item(index).firstChild.value=rowdata['status'];
                        row.cells.item(index).firstChild.value=stateus;
                    }
                } catch (error) {
                    console.log(error);
                }
                
            });
        }catch(e){
            //
            alert(e);
        }

        try {

            if(errorFromDB!=="No Error"){
                //alert(errorFromDB)
                console.log(errorFromDB);
            }

        } catch (error) {
            //alert(error);
            console.log(error);
        }
    }

    function createNewStudent(){


    }

</script>
<link rel="stylesheet" href="css/123.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
 rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

<!--fav-icon-->
<link rel="shortcut icon" href="images/download.png"/>
</head>
<body>
<section class="main" style="background-image: url(images/slider3.jpg);">
        
        <nav>
            <a href="#" class="logo">
                <img src="images/logo.jpg" width="84px" title="ASH Discipline Monotoring System" alt="ASH Discipline Monotoring System"/>
            </a>
            <input class="menu-btn" type="checkbox" id="menu-btn"/>
            <label class="menu-icon" for="menu-btn">
                <span class="nav-icon"></span>
            </label>
            <ul class="menu" style="border-radius: 5px; padding:5px;">
                <!--<li><label id="teacher_id_label"><b>No id</b></label><li>-->
                <li><button type="button" onclick="showStudentProfiles(true)"><b>Students Profile</b></button><li>
                <li><button type="button" onclick="showAddCase(false)"><b>Cases</b></button></li>
                <li><button type="button" onclick="">School Rules</button><li>

                <li><button type="button" onclick=""><b>BOM</b></button></li>
                <li><button type="button" onclick="">Payment</button><li>
                <li><button type="button" onclick=""><b>Comment</b></button></li>
                <li><button type="button" onclick="">Discipline Committee</button><li>
                <li><button type="button" onclick="">Reports</button><li>
                <li><a href="login.php">logout</a></li>
                
            </ul>
        </nav>

        <div>
            <br>
            
            <br>
        </div>

        <div class="cases">
            
            <?php 
            
            try {
                //code...
                $valStudents = array();
                $valTeachers = array();
                $valParents = array();

                //encode teachres data
                try {
                    //code...
                    $valTeachers = json_encode($options_teachers);
                } catch (\Throwable $th) {
                    //throw $th;
                }

                //encode parent data
                try {
                    //code...
                    $valParents = json_encode($options_parents);
                } catch (\Throwable $th) {
                    //throw $th;
                }

                //encode student data
                try {
                    //code...
                    $valStudents = json_encode($options_students);
                } catch (\Throwable $th) {
                    //throw $th;
                }

                if (mysqli_num_rows($qry1) >= 1){
                    $valEcho;
                    $tichaId = $teacherID;
                    $errorId = $error;
                    //$options = array();
                    $index = 0;
                    //$ticha;
    
                    $val_profiles = array();
                    
                    //encode student profiles
                    try {
                        //code...
                        $val_profiles = json_encode($options_profiles);
                    } catch (\Throwable $th) {
                        //throw $th;
                    }

                    //encode cases
                    try {
                        //code...
                        $valEcho = json_encode($options);
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                
                    //$val_profiles = json_encode($options_profiles);
    
                    try {
                        //code...
                        echo "<br></br><br></br>";
                        
                        if($valEcho){
                            //$val_echo_string."populateTableCases($valEcho);";
    
                            echo "<script type='text/javascript'> window.onload = function(){
                                populateTableCases($valEcho,'$errorId',$val_profiles,$roww,$valStudents);
                                setAllData($valParents,$valStudents,$valTeachers,$valEcho);
                            };  </script>";
                        }
                    } catch (Throwable $th) {
                        //throw $th;
                    }
    
                    
                }else{
                    
                    echo "<script type='text/javascript'> window.onload = function(){
                        setIDUser($roww,$valStudents);
                        setAllData($valParents,$valStudents,$valTeachers,$valEcho);
                    };  </script>";
                }

            } catch (\Throwable $th) {
                //throw $th;
            }
            
             ?>
        </div>

        <div id="form_new_case" style="display:none;" class = "modal">
        <form  action="admin_add_student.php" method="post"style="width: 400px;">
              <div class="imgcontainer">
                
                <p style="font-size: 30px;">Enter new Student Details: </p>
            
              </div>
            
            <div class="container">
                <label for="teacher"><b>Admin ID</b></label>
                <input id="teacher_no" type ="text" placeholder="Admin id" name="teacher" required>

                <label for="regNo"><b>Student Registration Number</b></label>
                <input id="student_regNo" type ="number" placeholder="Student Reg" name="regNo" required>

                <label for="student_FName"><b>Student First Name</b></label>
                <input type ="text" placeholder="Enter student first name" name="student_FName" required>

                <label for="student_LName"><b>Student Last Name</b></label>
                <input type ="text" placeholder="Enter student last name" name="student_LName" required>
    
                <label for="student_form"><b>Student Form</b></label>
                <input type ="text" placeholder="Enter student Form" name="student_form" required>

                <button type="submit" >Submit</button>
    
            </div>
          
            <div class="container" style="background-color:#f1f1f1">
              <button type="button" onclick="showAddCase(false)" class="cancelbtn">Cancel</button>
            </div>
        </div>
        </form>
        </div>

        <div  id="the_cases" style="display:none;" class="the_cases">
            <INPUT hidden id="caseLoad" type="button" value="Load All Cases" onclick="" />
            <INPUT hidden type="button" value="Add Case" onclick="addRow('dataTable')" />  
                <TABLE id="dataTable" width="100%" bgcolor="white" border="1" bordercolor="black">
                    <TR>
                        <TD>No.</TD>
                        <TD>Case Id</TD>  
                        <TD>Parent</TD>
                        <TD>Penalty</TD>  
                        <TD>Action Taken</TD>
                        <TD>Status</TD>
                        <TD>  </TD>
                    </TR>  
                    
                </TABLE>
        </div>

        <div  id="student_div" style="display:none;" class="student_profiles">
                <INPUT type="button" value="Create New Student" onclick="showAddCase(true)" />

                <TABLE id="student_profiles" width="100%" bgcolor="white" border="1" bordercolor="black">
                    <TR>
                        <TD>No.</TD>
                        <TD>Student Reg No</TD>
                        <TD>Student Name</TD>
                        <TD>Form</TD> 
                        <TD>  </TD>
                    
                    </TR>  
                    
                </TABLE>
        </div>

        <div class = "chat-section">
        <button class="open-button" onclick="openForm()">Comment</button>

        <div class="chat-popup" id="myForm">
            <form action="/action_page.php" class="form-container">
                <h1>Your Comment</h1>

                <label for="msg"><b>Message</b></label>
                <textarea placeholder="Type message.." name="msg" required></textarea>

                <button type="submit" class="btn">Send</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
        </div>

        </div>
         <!--img-->
         <!--<div class="home-img" style="width: 500px;">
                
                <marquee width="90%" direction="left" onmouseover="this.stop();"
                onmouseout="this.start();">
                    <a href="#" style="color: white;">There is no magic wand that can resolve our problems
                    the solution rest with our work and discipline</a>
                    </marquee>
                    <marquee width="100%" direction="right" onmouseover="this.stop();"
                onmouseout="this.start();">
                    <a href="#" style="color: white;">Success is measured by your discipline and inner peace.</a>
                    </marquee>
            </div>-->
         <!--footer-------------
    <footer align="bottom">
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
    </footer> -->
   
</body>

</html>        