
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, intial-scale=1.0">
<title>ASH Discipline Monitoring System</title>
<link rel="stylesheet" href="css/123.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
 rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
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
  justify-content: center;
  background-Color:#666699;
}
span.psw {
  float: right;
  padding-top: 16px;
}
/* The Modal (background) */
.modal {
  display: flex; 
  position: fixed; 
  z-index: 1; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  justify-content: center;
  padding-top: 0px;
  font-size: 17px;
  

}

/* Modal Content/Box */
.modal-content {
    width: 400px;
    background-Color:#ff6600;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 10%; /* Could be more or less, depending on screen size */
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
</section>

	
        <!-- login modal start -->
        <div  class="modal">
  
            <form  action="login_check.php" method="post" style="
            width: 400px;
        ">
              <div class="imgcontainer">
            
                <p style="font-size: 22px;">Login to your account by: </p>  
              </div>
              <?php if(isset($_GET['error'])) { ?>
              <div class="alert alert-danger" role="alert">
                <?=$_GET['error']?>
            </div>
             <?php } ?>
          
              <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>
                
          
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="At least 8 characters" name="psw" required>
                <div class="mb-1">
                <label for ="role"><b>Choose Role</b></label></div>
                <select class="form-select mb-3="
                name="role"
                arial-label="Default select example">
                     <option value="Admin">Admin</option>
                     <option value="Teacher">Teacher</option>
                     <option value="Parent">Parent</option>
                     <option value="BOM">BOM</option>
                     <option value="Committee">Committee</option>
              </select>
                  
                  
                <button type="submit">Login</button>
                <label>
                  <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
              </div>
          
              <div class="container" style="background-color:#f1f1f1">
              <a href = "index.php"><button type="button" onclick="document.getElementById('id01').style.display='none'" 
                class="cancelbtn">Cancel</button></a>
                <span class="psw"><a href="register.php">Register Here</a></span>
                <span class="psw" style="margin-right: 11px;"><a href="#">Don't have Account?</a></span>
              </div>
            </form>
          </div>
        <!-- login modal end  -->
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