<?php include "db.php";
include "header.php";
include "navbar.php";
$result=mysqli_query($conn, "SELECT * FROM parties ");
$data=mysqli_fetch_all($result,MYSQLI_ASSOC);
$result1=mysqli_query($conn, "SELECT * FROM admin LIMIT 1 ");
$data1=mysqli_fetch_assoc($result1); $date=$data1['result_date'];
$cdate=date('Y-m-d');
if($cdate >= $date){
$show_result='';
}
else{
  $show_result='d-none';

  }
?>

        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <!-- Masthead Avatar Image-->
                <img class="mb-5" width='550' src="assets/img/bg.jpg" alt="" />
                <!-- Masthead Heading-->
                <h2 class="masthead-heading text-uppercase  font-weight-light mb-0">Online Voting System</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-2">Vote for the Best</p>
                <a href="parties.php" class='btn btn-outline-primary btn-large'>Vote Now</a>
            </div>
        </header>
    <!-- Page Content -->
    <header class=" masthead bg-dark text-center  py-5 mb-4">
  <div class="container mt-5" id="poll">
    <h1 class="font-weight-light text-white ">All Parties with thier Votes</h1>
    <h2 class="text-primary">Result wil be Announced at: <br> <?php echo $date?></h2>
   
  </div>
</header>
<div class="container" >
  <div class="row <?php echo $show_result?>">
    <!-- Team Member 1 -->
    <?php $lg=0; foreach($data as $dat)  {$pid=$dat['id']; 
    $sql=mysqli_query($conn,"SELECT * from votes where pid='$pid'");
    $row=mysqli_num_rows($sql); ?>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border shadow text-center">
        <img src="assets/img/<?php echo $dat['logo']?>" style="height:8rem" class="w-50  mx-auto " alt="...">
        <div class="card-body text-center">
          <h5 class="card-title mb-0"><?php echo $dat['name']?></h5>
          <h6 class="card-text mb-0 p-1">Total Votes: </h6>
          <h5 class="card-text text-primary mb-0 p-1">(<?php echo $row;   if($row >$lg){  $lg=$row; $pname=$dat['name'];$candidate=$dat['candidate'];
          $city=$dat['city'];} ?>) </h5>
         
        </div>
      </div>
   </div> <?php }  ?>
   </div>
  </div>
   <div class="bg-dark text-center text-white p-5 <?php echo $show_result?>">
   <h3 class=" "><span class="text-primary"><?php echo $pname;?></span> have Won the Election</h3> <br>
   <h4>Candidate:<span class="text-primary"> <?php echo $candidate?></span>  </h4> <br>
   <h4>City:<span class="text-primary"> <?php echo $candidate?></span></h4></div>
  <!-- /.row -->
     
       
        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
        <div class="scroll-to-top d-lg-none position-fixed">
            <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
        </div>
    
 <?php include "footer.php"?>