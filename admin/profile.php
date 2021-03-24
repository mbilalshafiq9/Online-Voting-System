<?php include "../db.php";
include "header.php";
include "navbar.php";
$error='d-none';
$email= $_SESSION['email'];
$result=mysqli_query($conn, "SELECT * FROM admin where email='$email' ");
$data=mysqli_fetch_assoc($result);
//Register Voter
if(isset($_POST['submit']))
{
    $id=$_POST['id'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$insert =mysqli_query($conn,"UPDATE `admin` SET `name`='$name',`email`='$email',`password`='$password' WHERE id='$id'");
  if($insert)
  {
	echo "<script> alert('Your Information is Updated  successfully!');window.location.href='index.php' </script>";
  }
  } 
?>
 <!-- Masthead-->
 <header class="masthead bg-primary text-white text-center"> 
     <h1 class="well">Update Your Information</h1>
	
<div class="container d-flex align-items-center flex-column bg-white border rounded shadow">
<h6 class=" text-danger p-3 error  <?php echo $error ?> " style="background-color:rgba(255,0,0,0.1)">*  <?php echo $msg ?> *
</h6>
                <div class="row">
<form method='POST' enctype="multipart/form-data">
					<div class="col-md-12 text-dark">
					
						<label class="">First Name</label>
						<input type="text" name="name" value="<?php echo $data['name']?>" class="form-control" required>
					
						<label>Email Address</label>
						<input type="email" name="email"  value="<?php echo $data['email']?>" class="form-control" required>
							
						<label>Password</label>
						<input type="text" name="password" pattern=".{8,}" title="Eight or more characters" value="<?php echo $data['password']?>" class="form-control" required>
					
						<input type="hidden" name="id" value="<?php echo $data['id']?>">
					
					
					<button type="submit" name='submit' class="btn btn-lg btn-info">Submit</button>					
					</div>
				</form> 
                </div>
                </div>
</header>