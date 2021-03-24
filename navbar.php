
      <?php 
include "db.php";
$nlog='d-block';
$log='d-none';
error_reporting(0);
session_start();
$email= $_SESSION['email'];
if($_SESSION['email']==true){
$email= $_SESSION['email'];
$name= $_SESSION['name']; 
$nlog='d-none';
$log='d-block';
$result=mysqli_query($conn, "SELECT * FROM voters WHERE email ='$email' ");
$final=mysqli_fetch_assoc($result);
}


?>
  <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">Online Voting System</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php">Home</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="parties.php">Parties</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php#poll">Poll</a></li>
                        <li class="nav-item mx-0 mx-lg-1 <?php echo $log?>"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="profile.php"><?php echo $final['name']?></a></li>
                        <li class="nav-item mx-0 mx-lg-1 <?php echo $log?>"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="logout.php">Logout</a></li>
                        <li class="nav-item mx-0 mx-lg-1 <?php echo $nlog?>"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="login.php">Login</a></li>
                        <li class="nav-item mx-0 mx-lg-1 <?php echo $nlog?>"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="register.php">Register</a></li>
                    

                    </ul>
                </div>
            </div>
        </nav>