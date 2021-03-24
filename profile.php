<?php include "db.php";
include "header.php";
include "navbar.php";
$error='d-none';
$email= $_SESSION['email'];
$result=mysqli_query($conn, "SELECT * FROM voters where email='$email' ");
$data=mysqli_fetch_assoc($result);
//Register Voter
if(isset($_POST['submit']))
{
    $id=$_POST['id'];
	$name=$_POST['name'];
	$fname=$_POST['fname'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$cnic=$_POST['cnic'];
	$phoneno=$_POST['phoneno'];
	$dob=$_POST['dob'];
	$address=$_POST['address'];
	$filename= $_FILES["picture"]["name"];
	$tempname=$_FILES["picture"]["tmp_name"];
	$folder="assets/img/".$filename;
	move_uploaded_file($tempname, $folder);
	if(!$filename){
		$picture=$data['picture'];
	}
	$insert =mysqli_query($conn,"UPDATE `voters` SET `name`='$name',`fname`='$fname',`email`='$email',`password`='$password',
    `cnic`='$cnic',`phoneno`='$phoneno',`dob`='$dob',`address`='$address',`picture`= '$filename' WHERE id='$id'");
	 
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
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>First Name</label>
								<input type="text" name="name" value="<?php echo $data['name']?>" class="form-control" required>
							</div>
							<div class="col-sm-6 form-group">
								<label>Last Name</label>
								<input type="text" name="fname"  value="<?php echo $data['fname']?>"class="form-control">
							</div>
                        </div>			
                        <div class="form-group">
						<label>Email Address</label>
						<input type="email" name="email"  value="<?php echo $data['email']?>" class="form-control" required>
                    </div>			
                    <div class="form-group">
						<label>CNIC</label>
						<input type="cnic" name="cnic" pattern="^[0-9+]{5}[0-9+]{7}[0-9]{1}$" title="13 digit number without dashes(390289735822)"  value="<?php echo $data['cnic']?>" class="form-control" required>
					</div>
                    <div class="row">
							<div class="col-sm-6 form-group">
								<label>Password</label>
								<input type="text" name="password" pattern=".{8,}" title="Eight or more characters" value="<?php echo $data['password']?>" class="form-control" required>
							</div>	
							<div class="col-sm-6 form-group">
								<label>dob</label>
								<input type="date" name="dob"  value="<?php echo $data['dob']?>" class="form-control" required>
							</div>	
				
						
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>phoneno</label>
								<input type="text" name="phoneno" value="<?php echo $data['phoneno']?>" class="form-control">
							</div>		
							<div class="col-sm-6 form-group">
								<label>picture</label>
								<input type="file" name="picture"   class="form-control">
							</div>	
										
						<div class="col-sm-12 form-group">
							<label>Address</label>
							<textarea value="<?php echo $data['address']?>"  name="address"rows="3" class="form-control"><?php echo $data['address']?></textarea>
						</div>	
						</div>						
						<input type="hidden" name="id" value="<?php echo $data['id']?>">
					
					
					<button type="submit" name='submit' class="btn btn-lg btn-info">Submit</button>					
					</div>
				</form> 
                </div>
                </div>
</header>