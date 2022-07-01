
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
}
span.psw {
  float: right;
  padding-top: 16px;
}
/* The Modal (background) */
.modal {
  display: flex; /* Hidden by default */
  position: absolute; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  
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
	</style>
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
</section>

	
    <!-- register modal start -->
    <div class = "modal">
        <form  action="register_check.php" method="post"style="
            width: 400px;
        ">
              <div class="imgcontainer">
                
                <p style="font-size: 22px;">fill up the form based on role: </p>
                <hr>
              </div>
    <div class="container">
    <label for="firstname"><b>First Name</b></label>
    <input type ="text" placeholder="firstname" name="firstname" required>

    <label for="lastname"><b>Last Name</b></label>
    <input type="text" placeholder="lastname" name="lastname" required>

    <label for="TSCNo"><b>TSC Number</b></label>
    <input type="text" placeholder="Enter TAC Number" name="TSCNo" required>
         
    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="name@gmail.com" name="email" required>

    <label for="phone"><b>Phone Number</b></label>
    <input type="phone" placeholder="Enter phone" name="phone" required>

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
                <span class="psw"><a href="login.php">Login Here</a></span>
                <span class="psw" style="margin-right: 11px;"><a href="#">Already have Account?</a></span>
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