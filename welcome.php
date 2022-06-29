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
    /* Full-width input fields */
input[type=text], input[type=password] {
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
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}
.list{
  
  justify-content: left;
  align-items: start;
  text-align: start;
  
}



.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
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

/* Modal Content/Box */
.modal-content {
    width: 400px;
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
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

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>

<body>
    
    <section class="main" style="background-image: url(images/slider1.jpg);">
        
        <nav>
            <a href="#" class="logo">
                <img src="images/logo.jpg" width="84px" title="ASH Discipline Monotoring System" alt="ASH Discipline Monotoring System"/>
            </a>
            <input class="menu-btn" type="checkbox" id="menu-btn"/>
            <label class="menu-icon" for="menu-btn">
                <span class="nav-icon"></span>
            </label>
            <ul class="menu" style="border-radius: 5px;">
                <li><a href="#">Action</a></li>
                <li><a href="#">Infraction</a></li>
                <li><a href="#">Penalty</a></li>
                <li><a href="#">Served Cases</a></li>
                <li><a class="active" onclick="document.getElementById('id01').style.display='block'" style="width:auto; border-radius: 5px; cursor: pointer;">Login</a></li>
                <li><a class="active" onclick="document.getElementById('id02').style.display='block'"
                 style="width:auto; border-radius: 5px; cursor: pointer;">Register</a></li>
            </ul>
        </nav>
       
        <!-- login modal start -->
        <div id="id01" class="modal">
  
            <form class="modal-content animate" action="/action_page.php" method="post" style="
            width: 400px;
        ">
              <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" 
                class="close" title="Close Modal">&times;</span>
                <p style="font-size: 22px;">Login to your account on: </p>
                <hr>
              </div>
          
              <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>
          
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="At least 8 characters" name="psw" required>
                Choose Role:<select name="Role" id="Role">
                     <option value="Admin">Admin</option>
                     <option value="Teacher">Teacher</option>
                     <option value="Parent">Parent</option>
              </select>
                  
                  
                <button type="submit">Login</button>
                <label>
                  <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
              </div>
          
              <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" 
                class="cancelbtn">Cancel</button>
                <span class="psw"><a href="#">Register Here</a></span>
                <span class="psw" style="margin-right: 11px;"><a href="#">Don't have Account?</a></span>
              </div>
            </form>
          </div>
        <!-- login modal end  -->
        <!-- register modal start -->
        <div id = "id02" class = "modal">
        <form class="modal-content animate" action="/register.php" method="post"style="
            width: 400px;
        ">
              <div class="imgcontainer">
                <span onclick="document.getElementById('id02').style.display='none'" 
                class="close" title="Close Modal">&times;</span>
                <p style="font-size: 22px;">fill up the form based on role: </p>
                <hr>
              </div>
              <div class="container">
    <label for="firstname"><b>First Name</b></label>
    <input type ="text" placeholder="firstname" name="firstname" required>

    <label for="lastname"><b>Last Name</b></label>
    <input type="text" placeholder="lastname" name="lastname" required>

    <label for="TACNo"><b>TAC Number</b></label>
    <input type="text" placeholder="Enter TAC Number" name="TACNo" required>
         
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="name@gmail.com" name="email" required>

    <label for="phone"><b>Phone Number</b></label>
    <input type="text" placeholder="Enter phone" name="phone" required>

    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="At least 8 characters" name="psw" required>
        
    <label for="pswC"><b>Confirm Password</b></label>
    <input type="password" placeholder="Same as password above" name="pswC" required>
    
    <button type="submit">register</button>
        <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
              </div>
          
              <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id02').style.display='none'"
                 class="cancelbtn">Cancel</button>
                <span class="psw"><a href="#">Login Here</a></span>
                <span class="psw" style="margin-right: 11px;"><a href="#">Already have Account?</a></span>
              </div>
  </div>
</div>
</div>
</form>
</div>
 <!-- register modal end  -->


        <!--main-content-->
        <div class="home-content">
            
            <!--text-->
            <div class="home-text" >
                
                <h3 style="color: white; letter-spacing: 3px;">Welcome to ASH Discipline Monitoring System</h3>
                <h1 style="color: white;"> Discipline Portal</h1>
                <p style="color: white;">Discipline is one of the most crucial traits you may possess 
                  for academic achievement since it enables you to set objectives and 
                  achieve them, building your confidence and setting the groundwork for future success.</p>
            <!--login-btn-->
            <a href="#" class="main-login" style="border-radius: 5px;">Our Rules</a>
            </div>
            <!--img-->
            <div class="home-img" style="width: 500px;">
                <img src="images/images.jpg" width="200px" style="text-shadow: 20px 22px;"/>
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
        
        <!--arrow-->
        <div class="arrow"></div>
        <span class="scroll">Scroll</span>
    </section>
    
    <!--services----------------------->
    <section class="services">
        <!--heading----------->
        <div class="services-heading">
            <h2>OUR DICIPLINE OBJECTIVE</h2>
            <div class = "list">
            <ol>
            <li>To help the student develop and maintain self-control, respect for others and socially acceptable behavior.</li>
            <li>To promote morale and efficiency among the students.</li>
            <li>To develop the feeling of cooperation among the students.</li>
            </ol>
        </div>
        </div>
        <!--box-container----------------->
        <div class="box-container">
            <!--box-1-------->
            <div class="box">
                <img src="images/icon1.png">
                <h2>Your Role as Admin</h2>
                <p>Always ensure proper utilisation of workforce and materials for effective and 
                  well-organised teaching, learning and dicipline monitoring in the school.</p>
                <!--btn--------->
                <a href="#">Manage Here</a>
            </div>
            <!--box-2-------->
            <div class="box">
                <img src="images/icon2.png">
              <h2>Your Role as Teachers</h2>
                <p>You need take time to understand who your students are not who they wish they were,
                  not who they are supposed to be, not who the community says they are, but who they are.
                </p>
                <!--btn--------->
                <a href="#">Access Here</a>
            </div>
            <!--box-3-------->
            <div class="box">
                <img src="images/icon3.png">
                <h2>Message to Parents</h2>
                <p> Parents who who discipline their child by discussing the consequences of their actions produce
                  children who have better moral development, compared to children whose parents
                use authoritarian methods and punishment.  </p>
                <!--btn--------->
                <a href="#">Your Duty</a>
            </div>
           
            <!--box-1-------->
            
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
    <script>
        // Get the modal
        var modal = document.getElementById('id01');
        var modal = document.getElementById('id02');
        
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>
</body>

</html>
