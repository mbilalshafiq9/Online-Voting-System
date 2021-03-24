<?php include "../db.php";
include "header.php";
include "navbar.php";
$result=mysqli_query($conn, "SELECT * FROM parties ");
$data=mysqli_fetch_all($result,MYSQLI_ASSOC);
$party_no=mysqli_num_rows($result);
$result1=mysqli_query($conn, "SELECT * FROM voters ");
$voters_no=mysqli_num_rows($result1);
$result2=mysqli_query($conn, "SELECT * FROM votes ");
$votes_no=mysqli_num_rows($result2);
$date_sql=mysqli_query($conn, "SELECT * FROM admin LIMIT 1 ");
$date=mysqli_fetch_assoc($date_sql);
session_start();
$email=$_SESSION['email'];
if($_SESSION['email']==true){
$result = mysqli_query($conn,"SELECT * FROM admin WHERE email = '$email'");
$final=mysqli_fetch_assoc($result);
}
else{
    echo "<script> alert('Error! you need to login First ');window.location.href='../login.php' </script>";
}
if(isset($_POST['submit'])){
    $result_date=$_POST['date'];
    $insert =mysqli_query($conn,"UPDATE `admin` SET `result_date`='$result_date' WHERE id='1'");
    if($insert)
  {
	echo "<script> alert('Your Information is Updated  successfully!');window.location.href='index.php' </script>";
  }
}

?>

        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <h3 class="masthead-heading font-weight-light mb-0">Dashboard</h3>
                <hr class='w-25' style='border:3px solid white'>
            </div>
        </header>
    <!-- Page Content -->  <br> <br>
    <div class="container my-3">
    <div class="row text-white text-center">
    <div class="col-md-3 p-3 bg-success ml-5">
    <i class='fas fa-users mb-1' style='font-size:39px'></i>
    <h4 class='font-weight-normal'><?php echo $voters_no ?></h4>
   <h5 class=''> Voters</h5>
   <a href="voters.php" class='text-dark'>View Details>></a>
    </div>
    <div class="col-md-3 p-3 bg-info ml-3">
    <i class='fas fa-id-card-alt mb-1' style='font-size:39px'></i>
    <h4 class='font-weight-normal'><?php echo $party_no ?></h4>
   <h5 class=''> Parties</h5>
   <a href="parties.php" class='text-dark'>View Details>></a>
    </div>
    <div class="col-md-3  p-3 bg-danger ml-3">
    <i class='fas fa-poll mb-1' style='font-size:39px'></i>
    <h4 class='font-weight-normal'><?php echo $votes_no?></h4>
   <h5 class=''> Votes Casted</h5>
   <a href="votes.php" class='text-dark'>View Details>></a>
    </div>
    </div>
    </div> <br> <br>
    <div class="container">
        <h4>Result Date: <?php echo $date['result_date']?></h4>
        <button  data-toggle="modal" data-target="#date" class="btn btn-primary btn-outline-primary">Change Result Date</button>
        </div><br> 
    <div class="modal fade" id="date" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Result Time</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post">
      <label for="">Enter Result Date:</label>
      <input type="date" name="date"  class="form-control">
      
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name='submit' class="btn btn-primary">Save</button></form>
      </div>
    </div>
  </div>
</div> 
        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
        <div class="scroll-to-top d-lg-none position-fixed">
            <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
        </div>
    
 <?php include "./footer.php"?>