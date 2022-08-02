<?php

include("config.php");
include("function.php");

$roww = $_GET['details'];
$error = "No Error";

//$row_decoded = json_decode($roww);

//$parentID = $row_decoded['id'];
$parentID = $roww;

 $sql_cases = "SELECT * FROM cases WHERE parent_id = $parentID";
 //$sql_john = "SELECT * FROM persons WHERE forename = 'john'";

 $qry1 = mysqli_query($con, $sql_cases);
 $qryProfile = mysqli_query($con, $sql_cases);
 $index_cases = 0;
 $index = 0;
 $index_cases_new = 0;
 $options_profiles = array();
 $val_profiles;
 $options = array();



//while($ticha = mysqli_fetch_assoc($qry1)){
    //$valEcho = json_encode($ticha);
//    $options[$index] = $ticha;
//    $index = $index+1;
//    
//}
$validExecute = false;

//get teacher details
try {
    //code...
    if((mysqli_num_rows($qry1)) > 0){
        $validExecute = true;

        while($ticha_profile = mysqli_fetch_assoc($qry1)){
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
    
            try {
                //code...
    
                $case_id = $ticha_profile['id'];
                $infraction_item = $ticha_profile['infraction'];
                $status = $ticha_profile['status'];
                $penalty = $ticha_profile['penalty'];
                $actionTaken = $ticha_profile['action'];
    
            } catch (\Throwable $th) {
                //throw $th;
            }
    
            $p_id = $ticha_profile['teacher_id'];
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
    
    
            if("No name"!==$parent_name){
                $new_array = array(
                    "student_reg"=>$student_reg,
                    "student_name"=>$student_name,
                    "form"=>$form,
                    "id"=>$case_id,
                    "parent_name"=>$parent_name,
                    "infraction"=>$infraction_item,
                    "status"=>$status,
                    "penalty"=>$penalty,
                    "action"=>$actionTaken
                );
        
                $options[$index_cases_new] = $new_array;
                $index_cases_new = $index_cases_new+1;
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
<title>ASH Discipline Monitoring System</title>
<script>
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
            element1.setAttribute('value', 'Edit'); // or element1.value = "button";  
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

    function populateTableCases(rowdata_orig,errorFromDB,profiles){

        var teacherID;

        try {
            populateStudentProfiles(profiles,errorFromDB)
        } catch (error) {
            //
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
                //ttt_id = rowdata['teacher_id'];
                stateus = "null";
                for (let index = 1; index < 6; index++) {
                    if(index===1){
                        stateus = rowdata['id'];
                    }else if(index===2){
                        stateus = rowdata['parent_name'];
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

            var old_student_name = "No name";

            rowdata_orig.forEach(rowdata => {
                var rowCount = table.rows.length;

                if(old_student_name!==rowdata['student_name']){
                    old_student_name = rowdata['student_name'];

                    addRow('student_profiles');

                    var row = table.rows[rowCount];
                    //ttt_id = rowdata['teacher_id'];
                    stateus = "null";
                    try {
                        for (let index = 1; index < 8; index++) {
                            if(index===1){
                                stateus = rowdata['student_reg'];
                            }else if(index===2){
                                stateus = rowdata['student_name'];
                            }else if(index===3){
                                stateus = rowdata['form'];
                            }else if(index===4){
                                stateus = rowdata['case_id'];
                            }else if(index===5){
                                stateus = rowdata['parent_name'];
                            }else if(index===6){
                                stateus = rowdata['infraction'];
                            }else if(index===7){
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
                    } catch (error) {
                        console.log(error);
                    }

                }
            });

            try {
                    var ticha_ID_Element = document.getElementById('teacher_id_label');
                    //ticha_ID_Element.innerHTML=" ID : "+rowdata['teacher_id'];
                    //ticha_ID_Element.innerHTML=" ID : "+ttt_id;
            } catch (error) {
                //
            }

            
         
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
        }
    }

</script>
<link rel="stylesheet" href="css/123.css"/>
<!--fav-icon-->
<link rel="shortcut icon" href="images/download.png"/>


</head>
<body>
<section class="main" style="background-image: url(images/slider2.jpg);">
        
        <nav>
            <a href="#" class="logo">
                <img src="images/logo.jpg" width="84px" title="ASH Discipline Monotoring System" alt="ASH Discipline Monotoring System"/>
            </a>
            <input class="menu-btn" type="checkbox" id="menu-btn"/>
            <label class="menu-icon" for="menu-btn">
                <span class="nav-icon"></span>
            </label>
            <ul class="menu" style="border-radius: 5px;">
                <li><button type="button" onclick="showStudentProfiles(true)">Student Profile</button><li>
                <li><button type="button" onclick="showAddCase(false)">Cases</button><li>
                <li><button type="button" onclick="">comment</button><li>
                <li><button type="button" onclick="">payment</button><li>
                <li><a href ="login.php">logout</a><li>
                
            </ul>
        </nav>

        <div>
            <br>
            
            <br>
        </div>

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
                $val_profiles = json_encode($options_profiles);

                $valEcho = json_encode($options);

                //$val_profiles = json_encode($options_profiles);

                try {
                    //code...
                    echo "<br></br><br></br>";
                    
                    if($valEcho){
                        //$val_echo_string."populateTableCases($valEcho);";

                        echo "<script type='text/javascript'> window.onload = function(){
                            populateTableCases($valEcho,'$errorId',$val_profiles);
                        };  </script>";
                    }
                } catch (Throwable $th) {
                    //throw $th;
                }

                
             }
             ?>
        </div>

        <div id="form_new_case" style="display:none;" class = "modal">
        <form  action="teacher_add_case.php" method="post"style="width: 400px;">
              <div class="imgcontainer">
                
                <p style="font-size: 30px;">Report Case Here: </p>
            
              </div>
            
            <div class="mb-3">
                <label for="teacher"><b>Teacher ID</b></label>
                <input type ="text" placeholder="Teacher id" name="teacher" required>

                <label for="student"><b>Student Reg ID</b></label>
                <input type ="text" placeholder="Enter student reg no." name="student" required>

                <label for="infraction"><b>Infraction</b></label>
                <input type="text" placeholder="theft" name="infraction" required>

                <label for="penalty"><b>Penalty</b></label>
                <input type="text" placeholder="penalty" name="penalty" required>
         
                <label for="action"><b>Action</b></label>
                <input type="action" placeholder="verbal warning" name="action" required>
    
                <button type="submit" >Submit</button>
    
            </div>
          
            <div class="container" style="background-color:#f1f1f1">
              <button type="button" onclick="showAddCase(false)" class="cancelbtn">Cancel</button>
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
                        <TD>Teacher Name</TD>
                        <TD>Penalty</TD>  
                        <TD>Action Taken</TD>
                        <TD>Status</TD>
                        <TD>  </TD>
                    </TR>  
                    
                </TABLE>
        </div>



        <div  id="student_div" style="display:none;" class="student_profiles">
             
                <TABLE id="student_profiles" width="100%" bgcolor="white" border="1" bordercolor="black">
                    <TR>
                        <TD>No.</TD>
                        <TD>Student Reg Id</TD>
                        <TD>Student Name</TD>
                        <TD>Form</TD>
                        <TD>Case Id</TD>
                        <TD>Parent Name</TD>
                        <TD>Infraction</TD> 
                        <TD>Status</TD>
                    
                    </TR>  
                    
                </TABLE>
        </div>
         <!--img-->
         <div class="home-img" style="width: 500px;">
                
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