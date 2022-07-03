if($result){
                while(mysqli_fetch_assoc($result)){
                    echo'<script type="text/javascript">alert("logged in successfully and you are logged in as
                    ' .$row['Role'].'")</script>';
                }
            if (mysqli_num_rows($result) === 1) {
                ?>
                <script type = "text/javascript">
                    window.location.href= "admin.phhp"</script>
                    <?php
                    
                }elseif($Role==teacher){
                    ?>
                   <script type = "text/javascript">
                    window.location.href= "teacher.phhp"</script>
                     <?php
                }
            }else{
                ?>
                <script type = "text/javascript">
                    window.location.href= "parent.phhp"</script>
                    <?php
            }
            <?php if($_SESSION['role']== 'admin') {?>
                <?=$_SESSION['name']?>
               <a href ="admin.php"></a>
              <?php }?>
              <?php
session_start();
if(isset($_SESSION['uname']) &&isset($_SESSION['id']))
{ ?>

              <?php }else{
                header("location:login.php");
              } ?>            