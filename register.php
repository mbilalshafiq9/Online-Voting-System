<?php include "db.php";
include "header.php";
include "navbar.php";
$error='d-none';
//Register Voter
if(isset($_POST['submit']))
{
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
	$v_email = "SELECT 1 FROM voters WHERE email = '$email'";
	$result = mysqli_query($conn,$v_email);
	if(mysqli_num_rows($result)>0)
	{
		$msg = 'Email already exists';
		$error='d-block';
	}
	else{
	$insert =mysqli_query($conn,"INSERT INTO `voters`(`name`, `fname`, `email`,`password`,`cnic`, `phoneno`, `dob`,`address`,`picture`)
	VALUES('$name','$fname','$email','$password','$cnic','$phoneno','$dob','$address','$filename')");
	} 
  if(!$insert)
  {
	  echo mysqli_error($conn);
  }
  else {
	echo "<script> alert('Account is created successfully!');window.location.href='login.php' </script>";
  } }
?>
 <!-- Masthead-->
 <header class="masthead bg-primary text-white text-center"> 
     <h1 class="well">Registration Form</h1>
	
<div class="container d-flex align-items-center flex-column bg-white border rounded shadow">
<h6 class=" text-danger p-3 error  <?php echo $error ?> " style="background-color:rgba(255,0,0,0.1)">*  <?php echo $msg ?> *
</h6>
                <div class="row">
<form method='POST' enctype="mutltipart/form-data">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>First Name</label>
								<input type="text" name="name" placeholder="Enter Full Name Here.." class="form-control" required>
							</div>
							<div class="col-sm-6 form-group">
								<label>Last Name</label>
								<input type="text" name="fname" placeholder="Enter Father Name Here.." class="form-control">
							</div>
                        </div>			
                        <div class="form-group">
						<label>Email Address</label>
						<input type="email" name="email" placeholder="Enter Email Address Here.." class="form-control" required>
                    </div>			
                    <div class="form-group">
						<label>CNIC</label>
						<input type="cnic" name="cnic" pattern="^[0-9+]{5}[0-9+]{7}[0-9]{1}$" title="13 digit number without dashes(390289735822)"  placeholder="Enter Valid CNIC Here.." class="form-control" required>
					</div>
                    <div class="row">
							<div class="col-sm-6 form-group">
								<label>Password</label>
								<input type="text" name="password" pattern=".{8,}" title="Eight or more characters"placeholder="Enter Password Here.." class="form-control" required>
							</div>	
							<div class="col-sm-6 form-group">
								<label>dob</label>
								<input type="date" name="dob" placeholder="Enter DOB  Here.." class="form-control" required>
							</div>	
				
						
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>phoneno</label>
								<input type="text" name="phoneno" placeholder="Enter Phone No Here.." class="form-control">
							</div>		
							<div class="col-sm-6 form-group">
								<label>picture</label>
								<input type="file" name="picture" placeholder="Upload picture Here.." class="form-control">
							</div>	
										
						<div class="col-sm-12 form-group">
							<label>Address</label>
							<textarea placeholder="Enter Address Here.." name="address"rows="3" class="form-control"></textarea>
						</div>	
						</div>						
						
					
					
					<button type="submit" name='submit' class="btn btn-lg btn-info">Submit</button>					
					</div>
				</form> 
                </div>
                </div>
</header>