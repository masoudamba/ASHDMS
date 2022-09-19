
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
input[type=text], input[type=password],input[type=phone],input[type=action],input[type=email],
input[type=number],textarea[type=msg],input[type=subject]{
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
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
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}
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
/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
  justify-content: center;
}
.container {
  padding: 16px;
  background-color:#006666;
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
</style>
</head>

<body>

    <section class="main" style=" opacity: 1.0;background-image: url(images/slider1.jpg);">
        
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
                <li><a class="" onclick="document.getElementById('id01').style.display='block'"
                style="width:auto; border-radius: 5px; cursor: pointer;">Contact Us</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Signup</a></li>
                
            </ul>
        </nav>
       
     

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
            <a href="/ASHDMS/Documents/ASH Rules and Regulations.pdf" target="_blank" class="main-login" style="border-radius: 5px;">Our Rules</a>
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
    <div id="id01"style="display:none;" class = "modal" >
       
       <form class="modal-content animate"  action="contact.php" method="post" style="
            width: 400px;">
     
         <div class="imgcontainer"  >
           
            
           <h2><span>Get In Touch</span> With Us</h2>
           
         </div>
     
         <div class="container">
           <label for="name"><b>Full Name</b></label>
           <input type="text" placeholder="Your Name" name="name" required>
     
           <label for="email"><b>Email</b></label>
         <input type="email" placeholder="name@gmail.com" name="email">
     
         <label for="subject"><b>Subject</b></label>
         <input type="subject" placeholder="Your Subject" name="subject">   
    <label class="required" for="message">Your Message:</label><br />
    <textarea id="message" class="input" name="message" rows="7" cols="30"></textarea><br />
      
    <button type="submit" name="submit" value="Submit"> Send Message</button>
         <div class="container" style="background-color:#f1f1f1">
         <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
        </div>
     
         </div>
         
       </form>
     </div>
     <!-- contact us modal end  -->
    
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
                <a href="login.php">Manage Here</a>
            </div>
            <!--box-2-------->
            <div class="box">
                <img src="images/icon2.png">
              <h2>Your Role as Teachers</h2>
                <p>You need take time to understand who your students are not who they wish they were,
                  not who they are supposed to be, not who the community says they are, but who they are.
                </p>
                <!--btn--------->
                <a href="login.php">Access Here</a>
            </div>
            <!--box-3-------->
            <div class="box">
                <img src="images/icon3.png">
                <h2>Message to Parents</h2>
                <p> Parents who who discipline their child by discussing the consequences of their actions produce
                  children who have better moral development, compared to children whose parents
                use authoritarian methods and punishment.  </p>
                <!--btn--------->
                <a href="login.php">Your Duty</a>
            </div>
            <div class="box">
                <img src="images/bom.jpg">
                <h2>Role as BOM</h2>
                <p> Promote the best interests of the school and ensure that there is development within the school.  </p>
                <!--btn--------->
                <a href="login.php">Your Role</a>
            </div>
            <div class="box">
                <img src="images/committee.png">
                <h2>Are you part of the Committee?</h2>
                <p> Ensure protection of the school interest by establishing and
                   maintaining a framework for dealing with matters referred to 
                  you for discipline by the Inquiries, Complaints and Reports by the admin. </p>
                <!--btn--------->
                <a href="login.php">Handle here</a>
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
        
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>
</body>

</html>

