<?php

include("Mydb.php");
include("function.php");

$roww = $_GET['details'];
$error = "No Error";

$teacherID = $roww;

 $sql_cases = "SELECT * FROM cases";
 

 $sql_students = "SELECT * FROM students";

 $sql_teachers = "SELECT * FROM teachers";

 $sql_parents = "SELECT * FROM parents";

 $sql_bom = "SELECT * FROM bom";

 $sql_payment = "SELECT * FROM malipo";

 $sql_committee = "SELECT * FROM committee";

 //sort payment
 $indexPayment = 0;
 $qryPayment;
 $val_payment;
 $options_payment = array();

 try {
    //code...
    $qryPayment = mysqli_query($con, $sql_payment);   
   
   while($tichaTeacher = mysqli_fetch_assoc($qryPayment)){
       
       $options_payment[$indexPayment] = $tichaTeacher;
       $indexPayment = $indexPayment+1;
       
   }
 } catch (\Throwable $th) {
    //throw $th;
 }
 //sort bom
 $indexBom = 0;
 $qryBom;
 $val_bom;
 $options_bom = array();

 try {
    //code...
    $qryBom = mysqli_query($con, $sql_bom);   
   
   while($tichaTeacher = mysqli_fetch_assoc($qryBom)){
       $options_bom[ $indexBom] = $tichaTeacher;
       $indexBom =  $indexBom+1;
       
   }
 } catch (\Throwable $th) {
    //throw $th;
 }
 //sort committee
 $indexCommittee = 0;
 $qryCommittee;
 $val_committee;
 $options_committee = array();

 try {
    //code...
    $qryCommittee = mysqli_query($con, $sql_committee);   
   
   while($tichaTeacher = mysqli_fetch_assoc($qryCommittee)){
       
       $options_committee[$indexCommittee] = $tichaTeacher;
       $indexCommittee = $indexCommittee+1;
       
   }
 } catch (\Throwable $th) {
    //throw $th;
 }
 //sort teachers
 $indexTeachers = 0;
 $qryTeachers;
 $val_teachers;
 $options_teachers = array();

 try {
    //code...
    $qryTeachers = mysqli_query($con, $sql_teachers);   
   
   while($tichaTeacher = mysqli_fetch_assoc($qryTeachers)){
       
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
#popup{
 position: fixed;
display:none;
  z-index: 5;
  padding-top:
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%;
  overflow: auto; 
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.9); 
}
.popup-form{
 padding:10px;
 margin-top:200px;
 margin-left: auto;
 margin-right: auto;
 background-color:white;
 border-radius:5px;
 display: grid;
 grid-template-columns:0.5fr 1fr;

 width: 80%;
 max-width: 700px;
}
@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}/* Add Zoom Animation */
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
.modal-content {
   width: 400px;
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;

}
/* The Close Button */
.close {
  position: absolute;
  top: 35px;
  right: 35px;
  color: gray;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}
.form_new_cases {
   width: 400px;
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}
	
</style>

<title>ASH Discipline Monitoring System</title>
<!-- jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

<script>
    var ID_user = 0;
    var All_Parents;
    var All_Teachers;
    var All_Students;
    var All_Cases;
    var All_Committee;
    var All_Payments;
    var All_Bom;
    var Case_Level = "Pending";

   

    function setAllData(parents,students,teachers,cases,committee,payment,bom){
      
        try {
            All_Parents = parents;
            All_Teachers = teachers;
            All_Students = students;
            All_Cases = cases;
            All_Committee = committee;
            All_Payments = payment;
            All_Bom = bom;
            
        } catch (error) {
            console.log(error);
        }

        try {
            populateStudentProfiles(students,"No Error")
        } catch (error) {
            //
            console.log(error);
        }
        
        try {
            populateBomProfiles(bom,"No Error")
        } catch (error) {
            //
            console.log(error);
        }
        try {
            populateCommitteeProfiles(committee,"No Error")
        } catch (error) {
            //
            console.log(error);
        }
        try {
            populatePaymentProfiles(payment,"No Error")
        } catch (error) {
            //
            console.log(error);
        }


    }

    function setIDUser(id,students){
       
        try {
            ID_user = id;
        } catch (error) {
            console.log(error);
        }

        populateStudentsNewCase(students);
        
    }

    function populateStudentsNewCase(studentArray){

        try {
            
           
            var g = document.getElementById("student_reg_new_case");
          
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
           

            //Column 5  
            var cell1 = row.insertCell(4);  
            var element1 = document.createElement("input");  
            element1.type = "button";  
            var btnName = "button" + (rowCount + 1);  
            element1.name = btnName;  
            //element1.setAttribute('value', 'Student Details'); // or element1.value = "button";  
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
            var cell1 = row.insertCell(6);  
            var element1 = document.createElement("input");  
            element1.type = "button";  
            var btnName = "button" + (rowCount + 1);  
            element1.name = btnName;  
            element1.setAttribute('value', ' ... '); 
            element1.onclick = function () { editRow(btnName); }  
           

            
            var element2 = document.createElement("input");  
            element2.type = "button";  
            var btnName = "button" + (rowCount + 1);  
            element2.name = btnName;  
            element2.setAttribute('value', ' ');
            element2.onclick = function () { editRow_Case(btnName); } 
            
            element2.setAttribute('enabled',true);
            
            if(Case_Level === 'Completed'){
                element2.setAttribute('disabled',true);
            }else{
                element2.setAttribute('value', ' Update ');
            }
          
            cell1.appendChild(element2);

            cell1.appendChild(element1);

        }


          
    }

    function addPopups(rowdata_orig) {  
        var popup = document.getElementById("popup");  
        var span = document.getElementsByClassName("close")[0];

        span.onclick = function() {
        popup.style.display = "none";
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

           

            var table = document.getElementById('dataTable');  
            
            var ttt_id= "No id";

            rowdata_orig.forEach(rowdata => {
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

            try {
                    var ticha_ID_Element = document.getElementById('teacher_id_label');
                   
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
        
        
      
    }

    function showUpdateCase(showing){
        try {
            
            var g = document.getElementById("form_new_case");
            var h = document.getElementById("the_cases");
            var j = document.getElementById("form_update_case");

            showStudentProfiles(false);
            showBomProfiles(false);

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

            var g = document.getElementById("form_new_case");
            var h = document.getElementById("the_cases");

            showStudentProfiles(false);
            showBomProfiles(false);
            showPaymentProfiles(false);


            try {
                if(selectedValue){
                    g.style.display = "block";
                    h.style.display = "none";

                    var t_id = document.getElementById("teacher_no");
                    t_id.value = ID_user;
                   
                }else{
                    g.style.display = "none";
                    h.style.display = "block";
                }
            } catch (error) {
                alert(error);
            }
            
        
    }

    function showAddBom(selectedValue){

            var g = document.getElementById("form_new_bom");
            var h = document.getElementById("the_cases");
            var k = document.getElementById("bom_div");

            //showBomProfiles(false);

            try {
                if(selectedValue){
                    g.style.display = "block";
                    k.style.display = "none";

                    var t_id = document.getElementById("teacher_no_bom");
                    t_id.value = ID_user;
                   
                }else{
                    g.style.display = "none";
                    k.style.display = "block";
                }

                h.style.display = "none";
            } catch (error) {
                //alert(error);
                console.log(error);
            }
            
        
    }
    
    function showAddCom(selectedValue){

         var g = document.getElementById("form_new_com");
         var h = document.getElementById("the_cases");
         var k = document.getElementById("committee_div");

        //showBomProfiles(false);

        try {
        if(selectedValue){
            g.style.display = "block";
            k.style.display = "none";

            var t_id = document.getElementById("teacher_no_com");
            t_id.value = ID_user;
        
        }else{
            g.style.display = "none";
            k.style.display = "block";
        }

        h.style.display = "none";
        } catch (error) {
            //alert(error);
            console.log(error);
        }


    }

    function showBomProfiles(selectValue){

        try {
            
            var iProfile = document.getElementById("bom_div");

            if(selectValue){
                
                iProfile.style.display = "block";

                var g = document.getElementById("form_new_bom");
                var h = document.getElementById("the_cases");
                var j = document.getElementById("form_update_case");
                var f = document.getElementById("student_div");
                var m = document.getElementById("committee_div");
                g.style.display = "none";
                h.style.display = "none";
                j.style.display = "none";
                f.style.display = "none";
                m.style.display = "none";

                

            }else{
                iProfile.style.display = "none";
            }
        } catch (error) {
            //
        }

    }

    function showPaymentProfiles(selectValue){

        try {
            
            var iProfile = document.getElementById("payment_div");

            if(selectValue){
                
                iProfile.style.display = "block";

                var g = document.getElementById("form_new_bom");
                var h = document.getElementById("the_cases");
                var j = document.getElementById("form_update_case");
                var f = document.getElementById("student_div");
                var m = document.getElementById("committee_div");
                var l = document.getElementById("bom_div");
                g.style.display = "none";
                h.style.display = "none";
                j.style.display = "none";
                f.style.display = "none";
                m.style.display = "none";
                l.style.display = "none";

                

            }else{
                iProfile.style.display = "none";
            }
            } catch (error) {
                //
            }

            }

    function showComProfiles(selectValue){

        try {
        
        var iProfile = document.getElementById("committee_div");

        if(selectValue){
            
            iProfile.style.display = "block";

            var g = document.getElementById("form_new_com");
            var h = document.getElementById("the_cases");
            var j = document.getElementById("form_update_case");
            var f = document.getElementById("student_div");
            var l = document.getElementById("bom_div");
            var m = document.getElementById("payment_div");

            g.style.display = "none";
            h.style.display = "none";
            j.style.display = "none";
            f.style.display = "none";
            l.style.display = "none";
            m.style.display = "none";

            

        }else{
            iProfile.style.display = "none";
        }
        } catch (error) {
            //
        }

        }

    function addRowCom(tableID) {  
        var table = document.getElementById(tableID);  
        var rowCount = table.rows.length;  
        var row = table.insertRow(rowCount);  
        rowCount = rowCount-1;

        try{
            var rowCounttt = table.rows.length - 1; 
            var x = table.rows[rowCounttt].cells[0].value;
            rowCount = x; 
        }catch(e){
           
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
        

          
    }
    function addRowComBom(tableID) {  
        var table = document.getElementById(tableID);  
        var rowCount = table.rows.length;  
        var row = table.insertRow(rowCount);  
        rowCount = rowCount-1;

        try{
            var rowCounttt = table.rows.length - 1; 
            var x = table.rows[rowCounttt].cells[0].value;
            rowCount = x; 
        }catch(e){
           
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
        

          
    }

    function addRowPayment(tableID) {  
        var table = document.getElementById(tableID);  
        var rowCount = table.rows.length;  
        var row = table.insertRow(rowCount);  
        rowCount = rowCount-1;

        try{
            var rowCounttt = table.rows.length - 1; 
            var x = table.rows[rowCounttt].cells[0].value;
            rowCount = x; 
        }catch(e){
           
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
        

          
    }

    function populateBomProfiles(rowdata_orig,errorFromDB){
        var teacherID;

        try{

           

            var table = document.getElementById('bom_profiles');  
            
            var ttt_id= "No id";

            rowdata_orig.forEach(rowdata => {
                var rowCount = table.rows.length;

                addRowComBom('bom_profiles');

                var row = table.rows[rowCount];
              
                stateus = "null";
                try {
                    for (let index = 1; index < 4; index++) {
                        if(index===1){
                            stateus = rowdata['first_name'] +" "+rowdata['last_name'];
                        }else if(index===2){
                            stateus = rowdata['email'];
                        }else if(index===3){
                            stateus = rowdata['position'];
                        }   
                       
                        row.cells.item(index).firstChild.value=stateus;
                    }
                } catch (error) {
                    console.log(error);
                }
                
            });
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
           
            console.log(error);
        }
    }

    
    function populatePaymentProfiles(rowdata_orig,errorFromDB){
        var teacherID;

        try{

           

            var table = document.getElementById('payment_profiles');  
            
            var ttt_id= "No id";

            rowdata_orig.forEach(rowdata => {
                var rowCount = table.rows.length;

                addRowPayment('payment_profiles');

                var row = table.rows[rowCount];
              
                stateus = "null";
                try {
                    for (let index = 1; index < 4; index++) {
                        if(index===1){
                            stateus = rowdata['PhoneNumber'];
                        }else if(index===2){
                            stateus = rowdata['MpesaReceiptNumber'];
                        }else if(index===3){
                            stateus = rowdata['amount'];
                        } 
                        row.cells.item(index).firstChild.value=stateus;
                    }
                } catch (error) {
                    console.log(error);
                }
                
            });
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
           
            console.log(error);
        }
    }
    
    function populateCommitteeProfiles(rowdata_orig,errorFromDB){
        var teacherID;

        try{

           

            var table = document.getElementById('committee_profiles');  
            
            var ttt_id= "No id";

            rowdata_orig.forEach(rowdata => {
                var rowCount = table.rows.length;

                addRowCom('committee_profiles');

                var row = table.rows[rowCount];
              
                stateus = "null";
                try {
                    for (let index = 1; index < 4; index++) {
                        if(index===1){
                            stateus = rowdata['first_name'] +" "+rowdata['last_name'];
                        }else if(index===2){
                            stateus = rowdata['email'];
                        }else if(index===3){
                            stateus = rowdata['position'];
                        }   
                       
                        row.cells.item(index).firstChild.value=stateus;
                    }
                } catch (error) {
                    console.log(error);
                }
                
            });
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
           
            console.log(error);
        }
    }

    function showStudentProfiles(selectValue){

        try {
            
            var iProfile = document.getElementById("student_div");
            showBomProfiles(false);
            showPaymentProfiles(false);

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
            alert(e);
        }

        try {

            if(errorFromDB!=="No Error"){
               
                console.log(errorFromDB);
            }

        } catch (error) {
           
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
                        //row.cells.item(index).firstChild.value=rowdata['status'];
                            row.cells.item(index).firstChild.value=stateus;
                        }

                    }

                    
 
                });

            
         
            }catch(e){
            //
                alert(e);
            }
            


        } catch (error) {
            console.log(error);
        }


    }

    function download(url) {

        try {
            const a = document.createElement('a');
            a.href = url;
            a.download = url.split('/').pop();
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        } catch (error) {
            console.log(error);
            alert(error);
        }
        
    }

    function Convert_HTML_To_PDF() {
        var elementHTML = document.getElementById('contentToPrint');
        html2canvas(elementHTML, {
                    useCORS: true,
                    onrendered: function(canvas) {
                        var pdf = new jsPDF('p', 'pt', 'letter');

                        var pageHeight = 980;
                        var pageWidth = 900;
                        for (var i = 0; i <= elementHTML.clientHeight / pageHeight; i++) {
                            var srcImg = canvas;
                            var sX = 0;
                            var sY = pageHeight * i; // start 1 pageHeight down for every new page
                            var sWidth = pageWidth;
                            var sHeight = pageHeight;
                            var dX = 0;
                            var dY = 0;
                            var dWidth = pageWidth;
                            var dHeight = pageHeight;

                            window.onePageCanvas = document.createElement("canvas");
                            onePageCanvas.setAttribute('width', pageWidth);
                            onePageCanvas.setAttribute('height', pageHeight);
                            ctx.drawImage(srcImg, sX, sY, sWidth, sHeight, dX, dY, dWidth, dHeight);
                            var ctx = onePageCanvas.getContext('2d');

                            var width = onePageCanvas.width;
                            var canvasDataURL = onePageCanvas.toDataURL("image/png", 1.0);
                            
                            var height = onePageCanvas.clientHeight;
                            pdf.addPage(612, 864); // 8.5" x 12" in pts (inches*72)
                            if (i > 0) // if we're on anything other than the first page, add another page

                            pdf.addImage(canvasDataURL, 'PNG', 20, 40, (width * .62), (height * .62)); // add content to the page
                            pdf.setPage(i + 1); // now we declare that we're working on that page
                            
                        }
	                // Save the PDF
                        pdf.save('document.pdf');
                    }
        });
    }

    function downloadSimplePdf() {
        
        try {
            var doc = new jsPDF();

            doc.text(20, 20, 'Hello world!');
            doc.text(20, 30, 'This is client-side Javascript to generate a PDF.');

            // Add new page
            doc.addPage();
            doc.text(20, 20, 'Visit CodexWorld.com');

            // Save the PDF
            doc.save('document.pdf');
        } catch (error) {
            console.log(error);
            alert(error);
        }
    }


    function generatePDF() {
        var doc = new jsPDF();  //create jsPDF object
        doc.fromHTML(document.getElementById("popup"), // page element which you want to print as PDF
            15,
            15, 
            {
                'width': 370  //set width
            },
            function(a) 
            {
                doc.save("HTML2PDF.pdf"); // save file name as HTML2PDF.pdf
        });
    }

    function downloadPdf(){

        try {
            

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
</head>
<body>
<section class="main" style="background-image: url(images/slider3.jpg);">
        <div id="popup">
        <span class="close">&times;</span>
         <div id="popupForm" class="popup-form">
            <h3>Case</h3>    <h3 id="case-id">ID</h3>

            <p>Infraction</p><p id="infraction">Theft</p>

            <p>Student Name</p><p id="student-name">SNAME</p>

            <p>Student RegNo</p><p id="student-no">234534</p>

            <p>Form</p><p id="student-form">4</p>

            <p>Teacher Name</p>
            <p id="teacher-name">TNAME</p>
            <p>Parent Name</p><p id="parent-name">PNAME</p>
            <p>Status</p><p id="status">Status</p>

            
        </div>
            <button type="button" onclick="download('admin.php')">Download Report</button>
            <button type="button" onclick="generatePDF()">Download PDF Report</button>
        </div>
        <nav>
            <a href="#" class="logo">
                <img src="images/logo.jpg" width="84px" title="ASH Discipline Monotoring System" alt="ASH Discipline Monotoring System"/>
            </a>
            <input class="menu-btn" type="checkbox" id="menu-btn"/>
            <label class="menu-icon" for="menu-btn">
                <span class="nav-icon"></span>
            </label>
            <ul class="menu" style="border-radius: 5px; padding:5px;">
                
                <li><button type="button" onclick="showStudentProfiles(true)"><b>Students Profile</b></button><li>
                <li><button type="button" onclick="showAddCase(false)"><b>Cases</b></button></li>
                <li><button type="button" onclick="window.open('http://localhost/ASHDMS/Documents/ASH Rules and Regulations.pdf','_blank')">School Rules</button><li>

                <li><button type="button" onclick="showBomProfiles(true)"><b>BOM</b></button></li>
                <li><button type="button" onclick="showPaymentProfiles(true)">Payment</button><li>
                
                <li><button type="button" onclick="showComProfiles(true)">Discipline Committee</button><li>
                <li><button type="button" onclick="window.location.href='reports.php'">Reports</button><li>
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

                $valBom = array();
                $valPayment= array();
                $valCommittee = array();

                //encode payment data
                try {
                    //code...
                    $valPayment = json_encode($options_payment);
                } catch (\Throwable $th) {
                    
                }
                //encode committee data
                try {
                    //code...
                    $valCommittee = json_encode($options_committee);
                } catch (\Throwable $th) {
                    
                }
                //encode bom data
                try {
                    //code...
                    $valBom = json_encode($options_bom);
                } catch (\Throwable $th) {
                    
                }
                //encode teachres data
                try {
                    //code...
                    $valTeachers = json_encode($options_teachers);
                } catch (\Throwable $th) {
                    
                }

                //encode parent data
                try {
                    //code...
                    $valParents = json_encode($options_parents);
                } catch (\Throwable $th) {
                    
                }

                //encode student data
                try {
                    //code...
                    $valStudents = json_encode($options_students);
                } catch (\Throwable $th) {
                  
                }

                if (mysqli_num_rows($qry1) >= 1){
                    $valEcho;
                    $tichaId = $teacherID;
                    $errorId = $error;
                   
                    $index = 0;
                   
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
                        
                    }
                
                    
    
                    try {
                        //code...
                        echo "<br></br><br></br>";
                        
                        if($valEcho){
                            
    
                            echo "<script type='text/javascript'> window.onload = function(){
                                populateTableCases($valEcho,'$errorId',$val_profiles,$roww,$valStudents);
                                addPopups($valEcho); 
                                setAllData($valParents,$valStudents,$valTeachers,$valEcho,$valCommittee,$valPayment,$valBom);
                            };  </script>";
                        }
                    } catch (Throwable $th) {
                       
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
        <form  class="modal-content animate"action="admin_add_student.php" method="post"style="width: 400px;">
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
        <div  id="payment_div" style="display:none;" class="payment_profiles">
               

                <TABLE id="payment_profiles" width="100%" bgcolor="white" border="1" bordercolor="black">
                    <TR>
                        <TD>No.</TD>
                        <TD> phone</TD>
                        <TD> Mpesa_receipt</TD>
                        <TD>Amount</TD> 
                        
                        <TD>  </TD>
                    
                    </TR>  
                    
                </TABLE>
        </div>
        <div  id="committee_div" style="display:none;" class="committee_profiles">
                <INPUT type="button" value="Create New Committee " onclick="showAddCom(true)" />

                <TABLE id="committee_profiles" width="100%" bgcolor="white" border="1" bordercolor="black">
                    <TR>
                        <TD>No.</TD>
                        <TD> Name</TD>
                        <TD> Email</TD>
                        <TD>Position</TD> 
                        <TD>  </TD>
                    
                    </TR>  
                    
                </TABLE>
        </div>
         <!-- Creating new Members of Board Of Management -->
         <div id="form_new_com" style="display:none;" class = "modal">
        <form  class="modal-content animate" action="admin_add_com.php" method="post"style="width: 400px;">
              <div class="imgcontainer">
                
                <p style="font-size: 30px;">Enter new Committee Details: </p>
            
              </div>
            
            <div class="container">
                <label for="teacher"><b>Admin ID</b></label>
                <input id="teacher_no_com" type ="text" placeholder="Admin id" name="teacher_com_id" required>

                <label for="com_FName"><b> First Name</b></label>
                <input type ="text" placeholder="Enter first name" name="com_FName" required>

                <label for="com_LName"><b> Last Name</b></label>
                <input type ="text" placeholder="Enter last name" name="com_LName" required>
    
                <label for="com_email"><b>Email</b></label>
                <input type ="email" placeholder="Enter email" name="com_email" required>

                <label for="position"><b>Position</b></label>
                <input type ="text" placeholder="Enter position" name="position" required>

                <label for="uname"><b>Username</b></label>
                <input type ="text" placeholder="Create username" name="uname" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Create Password" name="psw" required>

                <button type="submit" >Submit</button>
    
            </div>
          
            <div class="container" style="background-color:#f1f1f1">
              <button type="button" onclick="showAddCom(false)" class="cancelbtn">Cancel</button>
            </div>
        </div>
        </form>
        </div>


        <div  id="bom_div" style="display:none;" class="bom_profiles">
                <INPUT type="button" value="Create New BOM Member" onclick="showAddBom(true)" />

                <TABLE id="bom_profiles" width="100%" bgcolor="white" border="1" bordercolor="black">
                    <TR>
                        <TD>No.</TD>
                        <TD>BOM Name</TD>
                        <TD>BOM Email</TD>
                        <TD>Position</TD> 
                        <TD>  </TD>
                    
                    </TR>  
                    
                </TABLE>
        </div>


        <!-- Creating new Members of Board Of Management -->
        <div id="form_new_bom" style="display:none;" class = "modal">
        <form  class="modal-content animate" action="admin_add_bom.php" method="post"style="width: 400px;">
              <div class="imgcontainer">
                
                <p style="font-size: 30px;">Enter new BOM Details: </p>
            
              </div>
            
            <div class="container">
                <label for="teacher"><b>Admin ID</b></label>
                <input id="teacher_no_bom" type ="text" placeholder="Admin id" name="teacher_bom_id" required>

                <label for="bom_FName"><b> First Name</b></label>
                <input type ="text" placeholder="Enter bom first name" name="bom_FName" required>

                <label for="bom_LName"><b> Last Name</b></label>
                <input type ="text" placeholder="Enter bom last name" name="bom_LName" required>
    
                <label for="bom_email"><b>Email</b></label>
                <input type ="email" placeholder="Enter email" name="bom_email" required>

                <label for="position"><b>Position</b></label>
                <input type ="text" placeholder="Enter position" name="position" required>

                <label for="uname"><b>Username</b></label>
                <input type ="text" placeholder="Create username" name="uname" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Create Password" name="psw" required>

                <button type="submit" >Submit</button>
    
            </div>
          
            <div class="container" style="background-color:#f1f1f1">
              <button type="button" onclick="showAddBom(false)" class="cancelbtn">Cancel</button>
            </div>
        </div>
        </form>
        </div>

        <div  id="the_cases" style="display:none;" class="the_cases">
            <INPUT hidden id="caseLoad" type="button" value="Load All Cases" onclick="" />

            <label for ="case-stage"><b>Choose Case Level</b></label>
            <select class="form-select mb-2=" onchange="processCases(this.value)"
                name="case-stage"
                arial-label="Default select example">
                     <option value="Pending">Pending</option>
                     <option value="Active">Active</option>
                     <option value="Escalated">Escalated</option>
                     <option value="Completed">Completed</option>
                     
            </select>

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


        <div id="form_update_case" style="display:none;" class = "modal">
        <form  action="admin_update_case.php" method="post"style="width: 400px;">
              <div class="imgcontainer">
                
                <p style="font-size: 30px;">Update Case Here: </p>
            
              </div>
            
            <div class="container">
                <label for="admin_id"><b>Admin ID</b></label>
                <input id="admin-id-update" type ="text" placeholder="Admin id" name="admin_id" required>

                <label for="case_id"><b>Case ID</b></label>
                <input id="case-id-update" type ="text" placeholder="Case id" name="case_id" required>

                <label for="teacher"><b>Teacher ID</b></label>
                <input id="teacher-id-update" type ="text" placeholder="Teacher id" name="teacher" required>

                <label for="parent"><b>Parent ID</b></label>
                <input id="student-id-update" type ="text" placeholder="Enter student reg no." name="parent" required>-->
               

                <label for="infraction"><b>Infraction</b></label>
                <input id="infraction-update" type="text" placeholder="theft" name="infraction" required>
                

                <label for="penalty"><b>Penalty</b></label>
                <input id="penalty-update" type="text" placeholder="penalty" name="penalty" required>
            
                
                <label for ="status"><b>Choose Case Level</b></label>
                <select id="status-update" class="form-select mb-3="
                    name="status"
                    arial-label="Default select example">
                        <option value="Pending">Pending</option>
                        <option value="Active">Active</option>
                        <option value="Escalated">Escalated</option>
                        <option value="Completed">Completed</option>                     
                </select>
         
                <label for="action"><b>Action</b></label>
               
                <input id="action-update" type="action" placeholder="verbal warning" name="action" required>

                <label for="verdict"><b>Verdict</b></label>
                <input id="verdict-update" type="text" placeholder="verdict" name="verdict" required>

                <label for="link"><b>Link</b></label>
                <input id="link-update" type="text" placeholder="link" name="link" required>

                <label for="date"><b>Date</b></label>
                <input id="date-update" type="text" placeholder="date" name="date" required>
    
                <button type="submit" >Submit</button>
    
            </div>
          
            <div class="container" style="background-color:#f1f1f1">
              <button type="button" onclick="showUpdateCase(false)" class="cancelbtn">Cancel</button>
            </div>
        </div>
        </form>
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
      
   
</body>

</html>        