<?php include "../db.php";
include "header.php";
include "navbar.php";
$error='d-none';

if(isset($_POST['submit']))
  {
    $email =  $_POST['email'];
    $password = $_POST['password'];
    $v_data = "SELECT * FROM admin WHERE email = '$email'  and Password = '$password'";
    $result = mysqli_query($conn,$v_data);
        if(mysqli_num_rows($result)>0)
        {session_start();
            $_SESSION['email']=$email;
          echo "<script> alert('Congratulations $email! you are successfully login.');window.location.href='index.php' </script>";
           
        }
    else{ $error="d-block";
       $msg="Email and Password not matched. Try Again";
    }
}
?>

        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column bg-white border rounded">
                <div class="row">
            <div class="col-md-6 ">
            <img src="../assets/img/bg.jpg" class='w-100 h-100' alt="">
            </div>
            <div class="col-md-6 border">
            <!--Display error message -->
            <h6 class=" text-danger p-3 error  <?php echo $error ?> " style="background-color:rgba(255,0,0,0.1)">*  <?php echo $msg ?> *
</h6>
                <h2 class="form-title text-center  m-5 pt-4 text-dark">Login as Admin</h2>
                    <div class="signin-form">
                  
                 <form method="POST" class="container " id="register-form">
                        
                    <div class="form-input">
                        <i class="fas fa-envelope mt-2 text-primary" style='position:absolute'></i>
                        <input type="text" name="email" class="input-txt" placeholder="Your Email" required>
                    </div>
                        <div class="form-input " id="show_hide_password">
                            <i class="fas fa-unlock mt-2 text-primary" style='position:absolute'></i>
                      <input type="password" name="password" class="input-txt pwd" placeholder="Password" required>
                        </div>
                      
                    <div class="form-input">
                        <input type="checkbox" name="agree"  class="input-txt check_box " > 
                        <span class='text-dark'>Remember Me  <a href="forgot_password.php" class='float-right '>Forgot Password?</a></span>  
                        </div>
                  
                    <div class="form-input   pt-4">
                        <input type="submit" name="submit" class=" btn btn-primary px-4" value="Login">
                        </div>
                    </form>
                    </div>
                </div>

            </div>
            </div>
        </header>
     
       
        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
        <div class="scroll-to-top d-lg-none position-fixed">
            <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
        </div>
    
 <?php include "footer.php"?>