<?php include "../db.php";
include "header.php";
include "navbar.php";
$updoc='d-none';
session_start();
$email=$_SESSION['email'];
if($_SESSION['email']==true){
$result = mysqli_query($conn,"SELECT * FROM admin WHERE email = '$email'");
$final=mysqli_fetch_assoc($result);
}
else{
    echo "<script> alert('Error! you need to login First ');window.location.href='../login.php' </script>";
}
$result=mysqli_query($conn, "SELECT * FROM voters ");
$data=mysqli_fetch_all($result,MYSQLI_ASSOC);
if($_GET['up']){
    $updoc='d-block';
    $id=$_GET['up'];
    $query1="SELECT * FROM voters where id=$id";
    $result1=mysqli_query($conn, $query1);
    $final1=mysqli_fetch_assoc($result1);
    $vid=$final1['id'];
}
      //Update Doctor
    if(isset($_POST['update']))
    { $id=$_POST['id'];
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
 //Delete Doctor
 if(isset($_POST['del']))
 {
  $id = $_POST['id'];
 $sql = "DELETE FROM voters WHERE id='$id'";
 $del=mysqli_query($conn, $sql);
     if($del){
         echo "<script> alert('Voter is Deleted Successfully!');window.location.href='voters.php' </script>";
     }
 }
?>
 <!-- Masthead-->
 <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <h3 class="masthead-heading font-weight-light mb-0">Registered Voters</h3>
                <hr class='w-25' style='border:3px solid white'>
            </div>
        </header>
        <div class=" m-5">
        
 <!-- Update Voter details -->
<h4 class='text-primary ml-5 <?php echo $updoc?>'>Edit Voter Details</h4> 
<div class="row ml-5  <?php echo $updoc?>">
<div class="col-md-8 border bg-light justify-content-center ">
<form method='POST' enctype="multipart/form-data">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>First Name</label>
								<input type="text" name="name" value="<?php echo $final1['name']?>" class="form-control" required>
							</div>
							<div class="col-sm-6 form-group">
								<label>Last Name</label>
								<input type="text" name="fname"  value="<?php echo $final1['fname']?>"class="form-control">
							</div>
                        </div>			
                        <div class="form-group">
						<label>Email Address</label>
						<input type="email" name="email"  value="<?php echo $final1['email']?>" class="form-control" required>
                    </div>			
                    <div class="form-group">
						<label>CNIC</label>
						<input type="cnic" name="cnic" pattern="^[0-9+]{5}[0-9+]{7}[0-9]{1}$" title="13 digit number without dashes(390289735822)"  value="<?php echo $final1['cnic']?>" class="form-control" required>
					</div>
                    <div class="row">
							<div class="col-sm-6 form-group">
								<label>Password</label>
								<input type="text" name="password" pattern=".{8,}" title="Eight or more characters" value="<?php echo $final1['password']?>" class="form-control" required>
							</div>	
							<div class="col-sm-6 form-group">
								<label>dob</label>
								<input type="date" name="dob"  value="<?php echo $final1['dob']?>" class="form-control" required>
							</div>	
				
						
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>phoneno</label>
								<input type="text" name="phoneno" value="<?php echo $final1['phoneno']?>" class="form-control">
							</div>		
							<div class="col-sm-6 form-group">
								<label>picture</label>
								<input type="file" name="picture"   class="form-control">
							</div>	
										
						<div class="col-sm-12 form-group">
							<label>Address</label>
							<textarea value="<?php echo $final1['address']?>"  name="address"rows="3" class="form-control"><?php echo $final1['address']?></textarea>
						</div>	
						</div>						
						<input type="hidden" name="id" value="<?php echo $final1['id']?>">
					
					
					<button type="submit" name='update' class="btn btn-lg btn-info">Submit</button>					
					</div>
				</form> </div></div> <br>
 <!-- Show Voters Table -->
        <div class="row">
        <div class="col-md-12">
        <table class='table'>
        <tr><th> #</th>
        <th> Name</th>
        <th> Father Name</th>
        <th> Picture</th>
        <th> Email</th>
        <th> password</th>
        <th> DOB</th>
        <th> CNIC</th>
        <th> Phone No</th>
        <th> Address</th>
        <th> Action</th>
        </tr>
        
        <?php $i=1; foreach($data as $dat){?>
            <form action="" method="post">
        <tr>
        <td><?php echo $i++ ?></td>
        <td><?php echo $dat['name']?></td>
        <td><?php echo $dat['fname']?></td>
        <td ><img class="w-25" src="../assets/img/<?php echo $dat['picture']?>" alt="pic"></td>
        <td><?php echo $dat['email']?></td>
        <td><?php echo $dat['password']?></td>
        <td><?php echo $dat['dob']?></td>
        <td><?php echo $dat['cnic']?></td>
        <td><?php echo $dat['phoneno']?></td>
        <td><?php echo $dat['address']?></td> <input type="hidden" name="id" value="<?php echo $dta['id']?>">
        <td><a class='btn btn-info' href="voters.php?up=<?php echo $dat['id']?>">Edit</a> <input type="submit" value="Delete" class='btn btn-danger' name="del" id=""></td>
        </tr> </form>
        <?php }?>
        </table>
        
        
        </div>
        </div></div>
<?php include "footer.php"?>