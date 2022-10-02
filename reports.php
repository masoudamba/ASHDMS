<?php

include("Mydb.php");


$User = "Admin";
$Stud ="stud";
$Active ="active";
$court_date = array();
$Most = "most";
$Comp ="complete";
$Pend = "pending";
$Esca = "escalated";
$Mostcom = "common";

$sql_cases = "SELECT * FROM cases";
$sql_active = "SELECT * FROM cases WHERE status ='Active'";
$sql_complete = "SELECT * FROM cases WHERE status ='Complete'";

$sql_pending = "SELECT * FROM cases WHERE status ='Pending'";
$sql_escalated = "SELECT * FROM cases WHERE status ='Escalated'";

$sql_students = "SELECT * FROM students";
$MostReported = "SELECT parent_id, COUNT(*) FROM cases GROUP BY parent_id";

$MostCommon= "SELECT infraction, COUNT(*) FROM cases GROUP BY infraction ORDER BY COUNT(*) DESC";
//all cases
try {

  $qryPayment = mysqli_query($con, $sql_cases); 
  $User = mysqli_num_rows($qryPayment);
} catch (\Throwable $th) {
  //throw $th;
}

//most common case
try {

  $qryPayment = mysqli_query($con, $MostCommon); 
 
  $Mostcom= (mysqli_fetch_assoc($qryPayment))['infraction'];

  $Common ="SELECT * FROM cases WHERE infaction =$Mostcom";
  $qryPayment = mysqli_query($con, $Common); 
  $MostC = (mysqli_fetch_assoc($qryPayment));
  $Mostcom = $MostC['infraction'];

} catch (\Throwable $th) {
  //throw $th;
}
//most reported student
try {

  $qryPayment = mysqli_query($con, $MostReported); 
 
  $Most = (mysqli_fetch_assoc($qryPayment))['parent_id'][0];

  $StudName ="SELECT * FROM parents WHERE id =$Most";
  $qryPayment = mysqli_query($con, $StudName); 
  $MostS = (mysqli_fetch_assoc($qryPayment));
  $Most = $MostS['student_reg_no'];

  $StudName ="SELECT first_name, last_name FROM students WHERE regNo=$Most";
  $qryPayment = mysqli_query($con, $StudName); 
  $MostS = (mysqli_fetch_assoc($qryPayment));
  $Most = $MostS['first_name']. ' ' .$MostS['last_name'];
} catch (\Throwable $th) {
  //throw $th;
}
//active cases
try {

  $qryPayment = mysqli_query($con, $sql_active); 
  $Active = mysqli_num_rows($qryPayment);
} catch (\Throwable $th) {
  //throw $th;
}

//Pending cases
try {

  $qryPayment = mysqli_query($con, $sql_pending); 
  $Pend = mysqli_num_rows($qryPayment);
} catch (\Throwable $th) {
  //throw $th;
}

//Completed cases
try {

  $qryPayment = mysqli_query($con, $sql_complete); 
  $Comp = mysqli_num_rows($qryPayment);
} catch (\Throwable $th) {
  //throw $th;
}

//Escalated cases
try {

  $qryPayment = mysqli_query($con, $sql_escalated); 
  $Esca = mysqli_num_rows($qryPayment);
} catch (\Throwable $th) {
  //throw $th;
}
//total students
try {
  
  $qryPayment = mysqli_query($con, $sql_students); 
  $Stud = mysqli_num_rows($qryPayment);
} catch (\Throwable $th) {
  //throw $th;
}

$court_date = array(
  "reported_cases"=>$User,
  "total_cases"=>$User,
  "pending_cases"=>$Pend,
  "completed_cases"=>$Comp,
  "numbers_reported"=>$Stud,
  "details"=>'infraction_item',
  "common_cases"=>$Mostcom,
  "escalated_cases"=>$Esca,
  "most"=>$Most,
  "active_cases"=>$Active,
  "total_students"=>$Stud
  

);




?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, intial-scale=1.0">
  <link rel="shortcut icon" href="images/download.png"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;1,300;1,500&display=swap" rel="stylesheet">
  <title>ASH Discipline Monitoring System</title>
  
  <style>

   .header{
  display: fex;
  justify-content: space-between;
  align-items: center;
  background: #fff;
  color: #cfb53b;
  padding: 10px;
  width: 100%;
  position: sticky;
  top: 0;
  
  box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
  /* margin-bottom: 18px; */
}

.display{
  display: flex;
  justify-content: right;
}


.logo-1 img{
  height: 60px;
  padding-top: 10px;
  padding-left: 20px;
}
.logo-1{
  padding: 0 20px;
}

.logo-2{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.logo-2 img{
  height: 60px;
  width: 60px;
  padding-top: 10px;
}

nav ul {
  display: flex;
  align-items: center;
  list-style: none;
}
nav ul li{
  padding: 10px;
}

nav ul li a {
  text-decoration: none;
  color: #cfb53b;
  padding: 10px;
}

nav ul li:hover{
  background: #293503;
  border-radius: 50%;
  -webkit-animation: vibrate-1 0.3s linear infinite both;
	        animation: vibrate-1 0.3s linear infinite both;
}

 @-webkit-keyframes vibrate-1 {
  0% {
    -webkit-transform: translate(0);
            transform: translate(0);
  }
  20% {
    -webkit-transform: translate(-2px, 2px);
            transform: translate(-2px, 2px);
  }
  40% {
    -webkit-transform: translate(-2px, -2px);
            transform: translate(-2px, -2px);
  }
  60% {
    -webkit-transform: translate(2px, 2px);
            transform: translate(2px, 2px);
  }
  80% {
    -webkit-transform: translate(2px, -2px);
            transform: translate(2px, -2px);
  }
  100% {
    -webkit-transform: translate(0);
            transform: translate(0);
  }
}
@keyframes vibrate-1 {
  0% {
    -webkit-transform: translate(0);
            transform: translate(0);
  }
  20% {
    -webkit-transform: translate(-2px, 2px);
            transform: translate(-2px, 2px);
  }
  40% {
    -webkit-transform: translate(-2px, -2px);
            transform: translate(-2px, -2px);
  }
  60% {
    -webkit-transform: translate(2px, 2px);
            transform: translate(2px, 2px);
  }
  80% {
    -webkit-transform: translate(2px, -2px);
            transform: translate(2px, -2px);
  }
  100% {
    -webkit-transform: translate(0);
            transform: translate(0);
  }
}

.burger-container{
  display: none;
}

.mobile-menu{
  font-size: 30px;
  display: none;
}

.menu{
  display: block;
}

.mobile-menu-open .mobile-menu{
  display: none;
}

.close-menu{
  display: none;
  font-size: 25px;
}

.mobile-menu-open .close-menu{
  display: block;
}

.mobile-menu-open .menu{
  display: block; 
}

.mobile-menu-open .menu ul {
  flex-direction: column;
}

.mobile-menu-open {
  height: 100vh;
  flex-direction: column;
}

@media only screen and (max-width: 850px) {
  .burger-container{
    display: block;
  }

  .mobile-menu{
    display: block;
  }
  .menu li{
    display: none;
  }
}
footeer {
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    background: #cfb53b;
    height: 50px;
    color: #fff;
  }
  general css

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html {
  height: 100%;
}

body{
  display: flex;
  flex-direction: column;
  font-family: 'Roboto', sans-serif;
  height: 100%;
}
#main-body,
#main-dashboard {
  flex: 1;
}

button{
  background-color: transparent;
  border: none;
  
}
.main-form{
  background: #999966;
  padding-top: 20px;
  padding-bottom: 20px;
}

.main-form .container{
  background: #fff;
}

.container .login-header{
  text-align: center;
  color: #cfb53b;
  border-bottom: solid #cfb53b 4px;
}

.main-form .container .input-group i{
  color: #cfb53b;
}


.main-form .container .btn-secondary{
  background:#4D6305;
  color: #cfb53b;
  
}

.main-form .container .btn-primary{
  background:#6600cc;
  color: #cfb53b;
  border: none;
  
}
.login-slot a{
  color: #cfb53b;
}
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  height: 100%;
}
.secondary{
  text-decoration: none;
  padding: 10px 15px;
  border-radius: 5px;
  background-color: #999999;
  color: #000;
  margin-bottom:20px;
  justify-content:right;
  
   
}
.headers{
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #fff;
  color:#B4ADAC;
  padding: 10px;
  width: 100%;
  position: sticky;
  top: 0;
  
  box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
  /* margin-bottom: 18px; */
}

.welcome {
  width: 100%;
  margin-bottom: 20px;
  padding: 10px 15px;
  border: 1px solid #cfb53b;
  border-radius: 5px;
}

.admin-dashboard {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
}

.dashboard-item {
  padding: 10px;
  border: 1px solid #cfb53b;
  border-radius: 5px;
  display: flex;
  justify-content: space-between;
}

.dashboard-item i {
  font-size: 90px;
  color: #cfb43a;
}

.dashboard-item a {
  display: inline-block;
  margin-top: 5px;
  text-decoration: none;
  background-color: #cfb43a;
  border-radius: 5px;
  color: #fff;
  padding: 5px 10px;
}

.dashboard-item a:hover {
  background-color: hsl(49, 61%, 62%);
}

.dashboard-item div {
  text-align: right;
  color: #cfb43a;
}

.dashboard-item div p {
  margin-bottom: 10px;
}

.details {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  margin-bottom: 20px;
}

.details div {
  margin-bottom: 10px;
}

.details p {
  font-weight: bold;
}

.details span {
  font-weight: initial;
}

.details p {
  margin-bottom: 0;
}

.print-btn {
  background-color: #dadada;
  border: 1px solid #cfb53b;
  border-radius: 5px;
  padding: 20px 30px;
}

.print-btn i {
  color: #cfb53b;
}

  </style>
</head>

<body>

  <header id="header">
    
    

  </header>

  <div id="main-dashboard" class="main-form">
    <div class="container">
      <div class="border shadow-lg p-3 w-75 mx-auto">
        <div class="headers" style=" border-bottom:solid 2px red;">
          <h1>Student and Cases Reports</h1>
          <div>
            <a href="admin.php" class="secondary">Back</a>
          </div>
        </div>

        <h2>Cases Report</h2>
        <div class="details">
          <div>
            <div>
              <p>Reported Cases: <span><?php echo $court_date['reported_cases'] ?></span></p>
            </div>
            <div>
              <p>Total Cases: <span><?php echo $court_date['total_cases'] ?></span></p>
            </div>
            <div>
              <p>Pending Cases <span><?php echo $court_date['pending_cases'] ?></span></p>
            </div>
          </div>
          <div>
            <div>
              <p>Active Cases: <span><?php echo $court_date['active_cases'] ?></span></p>
            </div>
            <div>
              <p>Completed Cases: <span><?php echo $court_date['completed_cases'] ?></span></p>
            </div>
          </div>
          <div>
            <div>
              <p>Escalated Cases:: <span><?php echo $court_date['escalated_cases'] ?></span></p>
            </div>
            <div>
              <p>Common Cases:: <span><?php echo $court_date['common_cases'] ?></span></p>
            </div>
          </div>
        </div>
        <h2>Students Report</h2>
        <div class="details">
          <div>
            <p>Total Students: <span><?php echo $court_date['total_students'] ?></span></p>
          </div>
          <div>
            <p>Numbers Reported: <span><?php echo $court_date['numbers_reported'] ?></span></p>
          </div>
         
          <div>
            <p>Most Reported: <span><?php echo 'Mr ' . $court_date['most']?></span></p>
          </div>
        </div>
        <button class="print-btn" onclick="window.print()">
          <i class="fa-solid fa-print"></i>
          Print
        </button>
      </div>

    </div>

  </div>

  
  <script type="text/javascript" src="./js/mobilemenu.js"></script>
</body>

</html>