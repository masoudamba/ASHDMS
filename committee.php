<?php

include("config.php");
include("function.php");

$roww = $_GET['details'];
$error = "No Error";

$teacherID = $roww;

 
 $sql_cases = "SELECT * FROM cases";
 

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
            $actionTaken;
            $penalty;
            $verdict;
            $link;
            $date;
    
            try {
                //code...
    
                $case_id = $ticha_profile['id'];
                $infraction_item = $ticha_profile['infraction'];
                $status = $ticha_profile['status'];
                $penalty = $ticha_profile['penalty'];
                $actionTaken = $ticha_profile['action'];
                $verdict = $ticha_profile['verdict'];
                $link =  $ticha_profile['link'];
                $date =  $ticha_profile['date'];
    
            } catch (\Throwable $th) {
                //throw $th;
            }
    
            $p_id = $ticha_profile['parent_id'];
            $sql_parent_id = "SELECT * FROM parents WHERE id = $p_id";
            $qryParentId = mysqli_query($con, $sql_parent_id);
    
            try {
                //code...
                while ($p_assoc = mysqli_fetch_assoc($qryParentId)) {
                    # code...
                    if($p_id===$p_assoc['id']){
                        $student_reg = $p_assoc['student_reg_no'];
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
                    "status"=>$status,
                    "penalty"=>$penalty,
                    "action"=>$actionTaken,
                    "verdict"=>$verdict,
                    "link"=>$link,
                    "date"=>$date
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

 //get student details
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
            $sql_parent_id = "SELECT * FROM parents WHERE id = $p_id";
            $qryParentId = mysqli_query($con, $sql_parent_id);
    
            try {
                //code...
                while ($p_assoc = mysqli_fetch_assoc($qryParentId)) {
                    # code...
                    if($p_id===$p_assoc['id']){
                        $student_reg = $p_assoc['student_reg_no'];
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
<link rel="stylesheet" href="css/123.css"/>
<!--fav-icon-->
<link rel="shortcut icon" href="images/download.png"/>
<style>
  

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
   
.list{
  
  justify-content: left;
  align-items: start;
  text-align: start;
  
}


/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: relative;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 5px 8px;
  z-index: 1;
}
.dropdown:hover .dropdown-content {
  display: block;
}
.dropdown-content p:hover {background-color: gray}
.dropdown-content li{
  color: black;
  padding: 12px 16px;

  
}

</style>
</head>

<script>
    var ID_user = 0;
    var All_Parents;
    var All_Teachers;
    var All_Students;
    var All_Cases;
    var Case_Level = "Active";

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

    function addRow22(tableID) {  
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
            option4.value = "Escalated";

            option1.label = "Pending";
            option2.label = "Completed";
            option3.label = "Active";
            option4.label = "Escalated";

            element3.class = "form-select";
            element3.appendChild(option1); 
            element3.appendChild(option2);
            element3.appendChild(option3);
            element3.appendChild(option4);
            element3.setAttribute('disabled',true);
            cell3.appendChild(element3);

            //Column 7  
            var cell1 = row.insertCell(6);  
            var element1 = document.createElement("input");  
            element1.type = "button";  
            var btnName = "button" + (rowCount + 1);  
            element1.name = btnName;  
            element1.setAttribute('value', ' ... '); // or element1.value = "button";  
            element1.onclick = function () { editRow(btnName); }  
            //element1.setAttribute('disabled',false);
            //cell1.appendChild(element1);

            
            var element2 = document.createElement("input");  
            element2.type = "button";  
            var btnName = "button" + (rowCount + 1);  
            element2.name = btnName;  
            element2.setAttribute('value', ' ');
            element2.onclick = function () { editRow_Case(btnName); } 
            // or element1.value = "button";  
            //.onclick = function () { confirmRow(btnName); }
            element2.setAttribute('enabled',true);
            
            if(Case_Level === 'Completed'){
                element2.setAttribute('disabled',true);
            }else{
                element2.setAttribute('value', ' Update ');
            }
            //element2.setAttribute('disabled',true);
            cell1.appendChild(element2);

            cell1.appendChild(element1);

        }


          
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
        //Column 5 
        var cell3 = row.insertCell(4);  
        var element3 = document.createElement("input");  
        element3.type = "text";
        element3.setAttribute('disabled',true);   
        cell3.appendChild(element3);

        

         
        if('student_profiles'===tableID){

            //Column 6  
            var cell3 = row.insertCell(5);  
            var element3 = document.createElement("input");  
            element3.type = "text";
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
            cell3.appendChild(element3);

        }else{

            //Column 6 
            var cell3 = row.insertCell(5);  
            var element3 = document.createElement("select");

            var option1 = document.createElement("option");
            var option2 = document.createElement("option");
            var option3 = document.createElement("option");
            var option4 = document.createElement("option");
            option1.value = "Pending";
            option2.value = "Completed";
            option3.value = "Active";
            option4.value = "Escalated";

            option1.label = "Pending";
            option2.label = "Completed";
            option3.label = "Active";
            option4.label = "Escalated";

            element3.class = "form-select";
            element3.appendChild(option1); 
            element3.appendChild(option2);
            element3.appendChild(option3);
            element3.appendChild(option4);
            element3.setAttribute('disabled',true);
            cell3.appendChild(element3);

            //Column 7 
            var cell6 = row.insertCell(6);  
            var element6 = document.createElement("input");  
            element6.type = "text";
            element6.setAttribute('disabled',true);   
            cell6.appendChild(element6);

            //Column 8 
            var cell7 = row.insertCell(7);  
            var element7 = document.createElement("form"); 
            var element71 = document.createElement("button");  
            element71.type = "submit";
            element71.innerHTML = "CLICK TO JOIN MEETING";
            element71.setAttribute('enabled',true);
            element7.appendChild(element71);
            cell7.appendChild(element7);

            //Column 9 
            var cell8 = row.insertCell(8);  
            var element8 = document.createElement("input");  
            element8.type = "text";
            element8.setAttribute('disabled',true);   
            cell8.appendChild(element8);

            //Column 10
            //var cell1 = row.insertCell(6);  
            var cell1 = row.insertCell(9); 
            var element1 = document.createElement("input");  
            element1.type = "button";  
            var btnName = "button" + (rowCount + 1);  
            element1.name = btnName;  
            element1.setAttribute('value', 'Appeal'); // or element1.value = "button";  
            element1.onclick = function () { editRow(btnName); }  
            element1.setAttribute('disabled',false);
            cell1.appendChild(element1);

            var element2 = document.createElement("input");  
            element2.type = "button";  
            var btnName = "button" + (rowCount + 1);  
            element2.name = btnName;  
            element2.setAttribute('value', 'Confirm'); // or element1.value = "button";  
            element2.onclick = function () { confirmRow(btnName); }  
            element2.setAttribute('disabled',true);
            //cell1.appendChild(element2);

        }


          
    }


    function addPopups(rowdata_orig) {  
        

        try {
            var popup = document.getElementById("popup");  
            var span = document.getElementsByClassName("close")[0];

            
        } catch (error) {
            console.log(error);
        }
        

        
    }  


    function setupErrorAndTeacherID(errorFromDB,teacherID){

        try {
            var teacher_id_el = document.getElementById('teacher_id_label'); 
            teacher_id_el.innerHTML=" ID : "+teacherID;

        } catch (error) {
            //
            //alert(error);
            console.log(error);
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
            //populateStudentsNewCase(students);
        } catch (error) {
            console.log(error);
        }

        try{

            //alert(rowdata);

            var table = document.getElementById('dataTable');  
            
            var ttt_id= "No id";

            rowdata_orig.forEach(rowdata => {
                var rowCount = table.rows.length;

                if(Case_Level === rowdata['status']){
                    addRow('dataTable');

                    var row = table.rows[rowCount];
                    ttt_id = rowdata['teacher_id'];
                    stateus = "null";
                    for (let index = 1; index < 9; index++) {
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

                        }else if(index===6){
                            stateus = rowdata['verdict'];
                        }else if(index===7){
                            stateus = rowdata['link'];

                            if('Pending'===stateus){
                                row.cells.item(index).firstChild.firstChild.setAttribute('disabled',true);
                            }else if('Completed'===stateus){
                                try {
                                    row.cells.item(index).firstChild.firstChild.setAttribute('disabled',true);
                                } catch (error) {
                                    console.log(error);
                                }
                                
                            }else if('Active'===stateus){
                                
                                try {
                                    row.cells.item(index).firstChild.firstChild.setAttribute('enabled',true);
                                    row.cells.item(index).firstChild.firstChild.action = stateus;
                                    row.cells.item(index).firstChild.firstChild.target = "_blank";

                                    row.cells.item(index).firstChild.action = stateus;
                                    row.cells.item(index).firstChild.setAttribute('enabled',true);
                                    row.cells.item(index).firstChild.target = "_blank";
                                } catch (error) {
                                    console.log(error);
                                }
                            }else{
                                row.cells.item(index).firstChild.action = stateus;
                            }
                        

                        }else if(index===8){
                            stateus = rowdata['date'];
                        }
                      
                        if(7!==index){
                            row.cells.item(index).firstChild.value=stateus;
                        }
                            

                    }


                }
 
            });

            try {
                    var ticha_ID_Element = document.getElementById('teacher_id_label');
                    
                    ticha_ID_Element.innerHTML=" ID : "+ttt_id;
            } catch (error) {
                //
            }

            
         
        }catch(e){
            //
            //alert(e);
            console.log(e);
        }

        try {

            if(errorFromDB!=="No Error"){
                console.log(errorFromDB);
                
            }

        } catch (error) {
            
        }
    }

    function editRow(btnName) { 
        var case_id = 0;
        var infraction = 'Unidentified';
        var status = 'Unidentified';
        var studentName = 'Unidentified';
        var parentName = 'Unidentified';
        var teacherName = 'Unidentified';
        var studentReg = 'Unidentified';
        var form = 'Unidentified';
        try {  
            var table = document.getElementById('dataTable');  
            var rowCount = table.rows.length;  
            for (var i = 0; i < rowCount; i++) {  
                var row = table.rows[i];
                
                var rowrowObj = row.cells.item(6).firstChild;
                case_id = row.cells.item(1).firstChild.value;
                
                if (rowrowObj.name == btnName) {  

                    //table.deleteRow(i);  
                    //rowCount--;  
                    //showCaseOfId(case_id);
                    //alert(case_id);
                    break;
                }  
            }
      
            
        }  
        catch (e) {  
            alert(e);  
        }

        //collect fields from db data
        try {
            var parentt_idd = 0;
            var teachert_idd = 0;

            //case details
            try {
                All_Cases.forEach(rowdata_casee => {

                    if(case_id===rowdata_casee['id']){
                        infraction = rowdata_casee['infraction'];
                        status = rowdata_casee['status'];
                        teachert_idd = rowdata_casee['teacher_id'];
                        parentt_idd = rowdata_casee['parent_id'];
                        //break;
                    }
 
                });
            } catch (error) {
                console.log(error);
            }

            //teachers details
            try {
                
                All_Teachers.forEach(rowdata => {

                    if(teachert_idd===rowdata['id']){
                        teacherName = rowdata['first_name']+" "+rowdata['last_name'];
                        //status = rowdata['status'];
                        //break;
                    }
 
                });
            } catch (error) {
                console.log(error);
            }

            //parents details
            try {
                
                All_Parents.forEach(rowdata_p => {

                    if(parentt_idd===rowdata_p['id']){
                        parentName = rowdata_p['first_name']+" "+rowdata_p['last_name'];
                        studentReg = rowdata_p['student_reg_no'];
                        //break;
                    }
 
                });
            } catch (error) {
                console.log(error);
            }

            //parents details
            try {
                
                All_Students.forEach(rowdata_student => {

                    if(studentReg===rowdata_student['regNo']){
                        studentName = rowdata_student['first_name']+" "+rowdata_student['last_name'];
                        form = rowdata_student['Form'];
                        //break;
                    }
 
                });
            } catch (error) {
                console.log(error);
            }
            
        } catch (error) {
            console.log(error);
        }



        var popup = document.getElementById("popup");

        //replace value in popup with the ones from db
        try {
            var cc = document.getElementById("case-id");
            cc.innerHTML = case_id;

            var infr = document.getElementById("infraction");
            infr.innerHTML = infraction;

            var stdname = document.getElementById("student-name");
            stdname.innerHTML = studentName;

            var studno = document.getElementById("student-no");
            studno.innerHTML = studentReg;

            var studform = document.getElementById("student-form");
            studform.innerHTML = form;

            var teaame = document.getElementById("teacher-name");
            teaame.innerHTML = teacherName;

            var parename = document.getElementById("parent-name");
            parename.innerHTML = parentName;

            var status_case = document.getElementById("status");
            status_case.innerHTML = status;
            
        } catch (error) {
            //
        }  
        
        
        popup.style.display = "block";
    }

    function editRow_Case(btnName) { 
        var case_id = 0;
        var infraction = 'Unidentified';
        var status = 'Unidentified';
        var studentName = 'Unidentified';
        var parentName = 'Unidentified';
        var teacherName = 'Unidentified';
        var studentReg = 'Unidentified';
        var form = 'Unidentified';
        try {  
            var table = document.getElementById('dataTable');  
            var rowCount = table.rows.length;  
            for (var i = 0; i < rowCount; i++) {  
                var row = table.rows[i];
                
                var rowrowObj = row.cells.item(6).firstChild;
                case_id = row.cells.item(1).firstChild.value;
                
                if (rowrowObj.name == btnName) {  

                    //table.deleteRow(i);  
                    //rowCount--;  
                    //showCaseOfId(case_id);
                    //alert(case_id);
                    break;
                }  
            }
      
            
        }  
        catch (e) {  
            alert(e);  
        }

        //collect fields from db data
        try {
            var parentt_idd = 0;
            var teachert_idd = 0;
            var action = 'Unidentified';
            var penalty = 'Unidentified';
            var verdict = 'Unidentified';
            var link = 'Unidentified';
            var date = 'Unidentified';
            

            //case details
            try {
                All_Cases.forEach(rowdata_casee => {

                    if(case_id===rowdata_casee['id']){
                        infraction = rowdata_casee['infraction'];
                        status = rowdata_casee['status'];
                        teachert_idd = rowdata_casee['teacher_id'];
                        parentt_idd = rowdata_casee['parent_id'];
                        action = rowdata_casee['action'];

                        penalty = rowdata_casee['penalty'];
                        verdict = rowdata_casee['verdict'];
                        link = rowdata_casee['link'];
                        date = rowdata_casee['date'];
                        //break;


                    }
 
                });
            } catch (error) {
                console.log(error);
            }
            
        } catch (error) {
            console.log(error);
        }



        //var popup = document.getElementById("popup");

        //replace value in popup with the ones from db
        try {

            var ac = document.getElementById("admin-id-update");
            ac.value = ID_user;

            var cc = document.getElementById("case-id-update");
            cc.value = case_id;

            var infr = document.getElementById("infraction-update");
            infr.value = infraction;

            var stdname = document.getElementById("student-id-update");
            stdname.value = parentt_idd;

            var teachno = document.getElementById("teacher-id-update");
            teachno.value = teachert_idd;

            var penal = document.getElementById("penalty-update");
            penal.value = penalty;

            var actionnu = document.getElementById("action-update");
            actionnu.value = action;

            var status_case = document.getElementById("status-update");
            status_case.value = status;

            var verd = document.getElementById("verdict-update");
            verd.value = verdict;

            var linkk = document.getElementById("link-update");
            linkk.value = link;

            var dateee = document.getElementById("date-update");
            dateee.value = date;

            showUpdateCase(true);
            
        } catch (error) {
            //
        }  
        
        
        //popup.style.display = "block";
    }

    function showUpdateCase(showing){
        try {
            
            var g = document.getElementById("form_new_case");
            var h = document.getElementById("the_cases");
            var j = document.getElementById("form_update_case");

            showStudentProfiles(false);

            if(showing){
                j.style.display = "block";
                h.style.display = "none";
                g.style.display = "none";
            }else{
                h.style.display = "block";
                j.style.display = "none";
                g.style.display = "none";
            }
        } catch (error) {
            console.log(error);
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

            //var g = document.getElementById("form_new_case");
            var g = document.getElementById("home-content");
            var h = document.getElementById("the_cases");

            showStudentProfiles(false);

            try {
                if(selectedValue){
                    g.style.display = "block";
                    h.style.display = "none";

                    //var t_id = document.getElementById("teacher_no");
                    //t_id.value = ID_user;
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
            console.log(error);
        }

    }

    function populateStudentProfiles(rowdata_orig,errorFromDB){
        var teacherID;

        try{

           

            var table = document.getElementById('student_profiles');  
            
            var ttt_id= "No id";

            rowdata_orig.forEach(rowdata => {
                var rowCount = table.rows.length;

                addRow('student_profiles');

                var row = table.rows[rowCount];
               
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
                     
                        row.cells.item(index).firstChild.value=stateus;
                    }
                } catch (error) {
                    console.log(error);
                }
                
            });
        }catch(e){
            //
            console.log(e);
            //alert(e);
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

    function empty_table_cases(){
        var table_orig = document.getElementById("dataTable");
        var rowCount_roig = table_orig.rows.length;
        try {

            while(table_orig.rows.length > 1) {
                table_orig.deleteRow(1);
            }

          
        } catch (error) {
            console.log(error);
        }
        
    }

    function processCases(value){

        try {

            Case_Level = value;

            empty_table_cases();

            try{
                var table = document.getElementById('dataTable');  
            
                var ttt_id= "No id";

                All_Cases.forEach(rowdata => {
                    var rowCount = table.rows.length;

                    if(Case_Level === rowdata['status']){
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
                       
                            row.cells.item(index).firstChild.value=stateus;
                        }

                    }

                    
 
                });

            
         
            }catch(e){
            //
                //alert(e);
                console.log(e);
            }
            


        } catch (error) {
            console.log(error);
        }


    }

</script>

<body>

    <section class="main" style="background-image: url(images/slider1.jpg);">
        
        <nav>
            <a href="#" class="logo">
                <img src="images/logo.jpg" width="84px"/>
            </a>
            <input class="menu-btn" type="checkbox" id="menu-btn"/>
            <label class="menu-icon" for="menu-btn">
                <span class="nav-icon"></span>
            </label>
            <ul class="menu" style="border-radius: 5px;">
                <ul class="dropdown">
                <li><a href="#">Action</a>
                <div class="dropdown-content">
                  <div class = "list">
                  <ol>
                  <li>Verbal Warning</li>
                  <li> Detention</li>
                  <li>Phone call to parent</li>
                  <li>Written note to parent</li>
                  <li>Assignment of writing a reflective summary of behavior</li>
                </ol>
                </div>
                </div>
                  </ul>
              </li>
              <ul class="dropdown">
                <li><a href="#">Infraction</a>
                <div class="dropdown-content">
                  <div class = "list">
                  <ol>
                  <li>Assault and insult on teachers and non- teachers</li>
                  <li>Assault on school officials</li>
                  <li>Mass protest</li>
                  <li>Cultism</li>
                  <li>Vandalism</li>
                  <li>Sleeping in class</li>
                  <li>Theft</li>
                  <li>Fighting</li>
                  <li>Examination mulpractise</li>
                  <li>Bullying</li>
                  <li>Drug abuse and alcholism</li>
                  <li>Speaking in pidgin English</li>
              </ol>
              </div>
                </div>
              </ul>
              </li>
                <ul class="dropdown">
                <li><a href="#">Penalty</a></li>
                <div class="dropdown-content">
                  <div class = "list">
                    <ol>
                  <li>Short-term suspension(less than 10 days)</li>
                  <li>Detention</li>
                  <li>In-school suspension</li>
                  <li>Long-term suspension(more than 10 days)</li>
                  <li>Expulsion(out if school indefinately)</li>
                </ol>
                 </div>
                </div>
                </ul>
                <ul class="menu" style="border-radius: 5px; padding:5px;">
                <li><button type="button" onclick="window.open('http://localhost/ASHDMS/Documents/ASH Rules and Regulations.pdf','_blank')">School Rules</button><li>

                <li><button type="button" onclick="showAddCase(false)"><b>Cases</b></button></li>
                <li><a href ="index.php">Home</a><li>
                <li><a href="login.php">Logout</a></li>
                </ul>
                
            </ul>
        </nav>
     

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
                                addPopups($valEcho); 
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

        <!--main-content-->
        <div id="home-content" class="home-content">
            
            <!--text-->
            <div class="home-text" >
                
                <h3 style="color: white; letter-spacing: 3px;">Welcome to ASH Displinary Committee Dashboard</h3>
                <h1 style="color: white;"> Displinary Committee Portal</h1>
                <p style="color: white;">A good Board Of Mananagement team is one where ideas are flowing fluidly, and where each idea is met with an initial welcome, an intellectual challenge, 
                an expression of gratitude, a rigorous scrutiny and a readiness for action.</p>
            <!--login-btn-->
            
            </div>
            <!--img-->
            <div class="home-img" style="width: 500px;">
                <img src="images/slider6.jpg" width="200px" style="text-shadow: 20px 22px;"/>
                <marquee width="90%" direction="left" onmouseover="this.stop();"
                onmouseout="this.start();">
                    <a href="#" style="color: white;">There is no magic wand that can resolve our problems
                    the solution rest with our work and discipline</a>
                    </marquee>
                    <marquee width="100%" direction="right" onmouseover="this.stop();"
                onmouseout="this.start();">
                    <a href="#" style="color: white;">Success is measured by your discipline and inner peace.</a>
                    </marquee>
            </div>
            
        </div>

        <div id="the_cases" style="display:none;" class="the_cases">
        <br></br><br></br>
                 <TABLE id="dataTable" width="100%" bgcolor="white" border="1" bordercolor="black">
                    <TR>
                        <TD>No.</TD>
                        <TD>Case Id</TD>  
                        <TD>Parent</TD>
                        <TD>Penalty</TD>  
                        <TD>Action Taken</TD>
                        <TD>Status</TD>
                        <TD>Verdict</TD>  
                        <TD>Link</TD>
                        <TD>Date</TD>
                        <TD>  </TD>
                    </TR>  
                    
                </TABLE>

        </div>
        
        <!--arrow-->
        <div class="arrow"></div>
        <span class="scroll">Scroll</span>
    </section>

    
    <!--services----------------------->
    <section id="services" class="services">
        <!--heading----------->
        <div class="services-heading">
            <h2>OUR OBJECTIVE AS Displinary Committee</h2>
            <div class = "list">
            <ol>
            <li>Provide direction for the school.</li>
            <li>To monitor and control function.</li>
            <li>To ensure the school's prosperity by collectively directing the schools's  disciplinary affairs.</li>
            </ol>
        </div>
        </div>
        
    </section>
    
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

