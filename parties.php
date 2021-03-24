<?php include "db.php";
include "header.php";
include "navbar.php";
$result=mysqli_query($conn, "SELECT * FROM parties ");
$data=mysqli_fetch_all($result,MYSQLI_ASSOC);
$email= $_SESSION['email'];
if($_SESSION['email']==true){
$email= $_SESSION['email'];
$sql=mysqli_query($conn, "SELECT * FROM voters WHERE email ='$email' ");
$final=mysqli_fetch_assoc($sql);}
if(isset($_POST['submit'])){
    if($_SESSION['email']==false){
        echo "<script> alert('Sorry! You need to login first to cast the vote.');window.location.href='login.php' </script>"; }
    $vid=$_POST['vid'];
    $pid=$_POST['pid'];
    $sql2=mysqli_query($conn, "SELECT 1 FROM votes WHERE vid ='$vid' ");
     if(mysqli_num_rows($sql2)>0)
    {
      echo "<script> alert('Sorry! Your Vote is Already Casted.');window.location.href='index.php' </script>";
    }
  else{  $insert =mysqli_query($conn,"INSERT INTO `votes`(`vid`, `pid`)   VALUES('$vid','$pid')");
     if($insert)
     {
      echo "<script> alert('Thank You for Casting the Vote!');window.location.href='index.php' </script>";
     }
     } 
}

?>

<!-- Header -->
<header class=" masthead bg-primary text-center mt-5 py-5 mb-4">
  <div class="container mt-5">
    <h1 class="font-weight-light text-white ">Vote the Best Party</h1>
  </div>
</header>

<!-- Page Content -->
<div class="container">
  <div class="row">
    <!-- Team Member 1 -->
    <?php foreach($data as $dat) {?>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border shadow text-center">
        <img src="assets/img/<?php echo $dat['logo']?>" class=" mx-auto " style="height:8rem" alt="...">
        <div class="card-body text-center">
          <h5 class="card-title mb-0"><?php echo $dat['name']?></h5>
        
          <!-- Button trigger modal -->
        <button type="button" class="card-text btn btn-primary mt-1" data-toggle="modal" data-target="#<?php echo $dat['name']?>">
        Vote Now
        </button>
        </div>
      </div>
   </div> <?php }?>
  
  </div>
  <!-- /.row -->

<!-- Modal -->
<?php foreach ($data as $dat){?>
<div class="modal fade" id="<?php echo $dat['name']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Vote</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Are You Sure You want to vote: <h4 class='text-primary text-center'> <?php echo $dat['name']?></h4>
       After that you cannot change your vote.
      </div>
      <div class="modal-footer">
      <form action="" method="post">
      <input type="hidden" name="vid" value="<?php echo $final['id']?>">
      <input type="hidden" name="pid" value="<?php echo $dat['id']?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name='submit' class="btn btn-primary">Yes, Vote</button> </form>
      </div>
    </div>
  </div>
</div>
</div>
<?php }?>
<!-- /.container -->
<?php include "footer.php"?>