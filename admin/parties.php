<?php include "../db.php";
include "header.php";
include "navbar.php";
$updoc='d-none'; $add='d-none';
session_start();
$email=$_SESSION['email'];
if($_SESSION['email']==true){
$result = mysqli_query($conn,"SELECT * FROM admin WHERE email = '$email'");
$final=mysqli_fetch_assoc($result);
}
else{
    echo "<script> alert('Error! you need to login First ');window.location.href='../login.php' </script>";
}
$result=mysqli_query($conn, "SELECT * FROM parties ");
$data=mysqli_fetch_all($result,MYSQLI_ASSOC);
if($_GET['add']){
    $add='d-block';
    $updoc='d-none';
    $query1="SELECT * FROM voters where id=$id";
    $result1=mysqli_query($conn, $query1);
    $final1=mysqli_fetch_assoc($result1);
    $vid=$final1['id'];
}//ADD New Party
if(isset($_POST['add']))
  {
    $name =  $_POST['name'];
    $candidate=$_POST['candidate'];
    $city=$_POST['city'];
    $description = $_POST['description'];
    $filename= $_FILES["picture"]["name"];
	$tempname=$_FILES["picture"]["tmp_name"];
	$folder="assets/img/".$filename;
	move_uploaded_file($tempname, $folder);
    $insert =mysqli_query($conn,"INSERT INTO `parties`(`name`,`candidate`,`city`, `description`,`logo`)
	VALUES('$name','$candidate','$city','$description','$filename')");
    if($insert){
        echo "<script> alert('Party is added successfully!');window.location.href='parties.php' </script>";
    }
        }
if($_GET['up']){
    $updoc='d-block';
    $id=$_GET['up'];
    $query1="SELECT * FROM parties where id=$id";
    $result1=mysqli_query($conn, $query1);
    $final1=mysqli_fetch_assoc($result1);
    $pid=$final1['id'];
}
      //Update Party
    if(isset($_POST['update']))
    { $id=$_POST['id'];
        $name=$_POST['name'];
        $candidate=$_POST['candidate'];
        $city=$_POST['city'];
        $description=$_POST['description'];
        $filename= $_FILES["picture"]["name"];
        $tempname=$_FILES["picture"]["tmp_name"];
        $folder="assets/img/".$filename;
        move_uploaded_file($tempname, $folder);
        if(!$filename){
            $picture=$final1['logo'];
        }
        $update =mysqli_query($conn,"UPDATE `parties` SET `name`='$name',`candidate`='$candidate',`city`='$city',`description`='$description',`logo`='$filename' WHERE id='$id'");
         
      if($update)
      {
        echo "<script> alert('Party Information is Updated  successfully!');window.location.href='parties.php' </script>";
      }
     
        }
 //Delete Partty
 if(isset($_POST['del']))
 {
  $id = $_POST['id'];
 $sql = "DELETE FROM parties WHERE id='$id'";
 $del=mysqli_query($conn, $sql);
     if($del){
         echo "<script> alert('Party is Deleted Successfully!');window.location.href='voters.php' </script>";
     }
 }
?>
 <!-- Masthead-->
 <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <h3 class="masthead-heading font-weight-light mb-0">Registered Parties</h3>
                <hr class='w-25' style='border:3px solid white'>
        <a class='btn btn-outline-primary'href="parties.php?add=true">Add New Party</a>
            </div>
        </header>
        <div class=" m-5">
 <!-- Add New Party  -->
<h4 class='text-primary ml-5 <?php echo $add?>'>Add New Party </h4> 
<div class="row ml-5  <?php echo $add?>">
<div class="col-md-8 border bg-light justify-content-center ">
<form method='POST' enctype="multipart/form-data">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>First Name</label>
								<input type="text" name="name" placeholder="Enter Party Name"class="form-control" required>
							</div>
                            <div class="col-sm-6 form-group">
								<label>Candidate Name</label>
								<input type="text" name="candidate" value="" class="form-control"placeholder="Candidate Name" required>
							</div>
							<div class="col-sm-6 form-group">
								<label>City</label>
								<input type="text" name="city" value="" class="form-control" placeholder="City" required>
							</div>
							<div class="col-sm-6 form-group h-25">
								<label>Picture</label> 
								<input type="file" name="picture"   class="form-control">
							</div>	
						<div class="col-sm-12 form-group">
							<label>Description</label>
							<textarea  placeholder="Enter Party Name" name="description"rows="3" class="form-control">Enter Party Description</textarea>
						</div>	
						</div>						
						<input type="hidden" name="id" value="<?php echo $final1['id']?>">
					<button type="submit" name='add' class="btn btn-lg btn-info mb-2">ADD</button>					
					</div>
				</form> </div></div> <br>
     
 <!-- Update Party details -->
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
								<label>Candidate Name</label>
								<input type="text" name="candidate" value="<?php echo $final1['candidate']?>" class="form-control" required>
							</div>
							<div class="col-sm-6 form-group">
								<label>City</label>
								<input type="text" name="city" value="<?php echo $final1['city']?>" class="form-control" required>
							</div>
							<div class="col-sm-6 form-group h-25">
								<label>picture</label> <img style='width:4rem' src="../assets/img/<?php echo $final1['logo']?>" alt="">
								<input type="file" name="picture"   class="form-control">
							</div>	
						<div class="col-sm-12 form-group">
							<label>Description</label>
							<textarea value="<?php echo $final1['description']?>"  name="description"rows="3" class="form-control"><?php echo $final1['description']?></textarea>
						</div>	
						</div>						
						<input type="hidden" name="id" value="<?php echo $final1['id']?>">
					<button type="submit" name='update' class="btn btn-lg btn-info mb-2">Update</button>					
					</div>
				</form> </div></div> <br>
 <!-- Show Voters Table -->
        <div class="row">
        <div class="col-md-12">
        <table class='table bg-light border'>
        <tr><th> #</th>
        <th> Name</th>
        <th> Candidate</th>
        <th> City</th>
        <th> Logo</th>
        <th> Description</th>
        <th> Action</th>
        </tr>
        
        <?php $i=1; foreach($data as $dat){?>
            <form action="" method="post">
        <tr>
        <td><?php echo $i++ ?></td>
        <td><?php echo $dat['name']?></td>
        <td><?php echo $dat['candidate']?></td>
        <td><?php echo $dat['city']?></td>
        <td ><img class="w-25" src="../assets/img/<?php echo $dat['logo']?>" alt="pic"></td>
        <td><?php echo $dat['description']?></td>
        <td><a class='btn btn-info' href="parties.php?up=<?php echo $dat['id']?>">Edit</a> <input type="submit" value="Delete" class='btn btn-danger' name="del" id=""></td>
        </tr> </form>
        <?php }?>
        </table>
        
        
        </div>
        </div></div>
<?php include "footer.php"?>