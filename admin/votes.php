<?php include "../db.php";
include "header.php";
include "navbar.php";session_start();
$email=$_SESSION['email'];
if($_SESSION['email']==true){
$result = mysqli_query($conn,"SELECT * FROM admin WHERE email = '$email'");
$final=mysqli_fetch_assoc($result);
}
else{
    echo "<script> alert('Error! you need to login First ');window.location.href='../login.php' </script>";
}
$updoc='d-none'; $add='d-none';
$result=mysqli_query($conn, "SELECT * FROM voters INNER JOIN votes on voters.id=votes.vid");
$data=mysqli_fetch_all($result,MYSQLI_ASSOC);
$result2=mysqli_query($conn, "SELECT * FROM parties ");
$data2=mysqli_fetch_all($result2,MYSQLI_ASSOC);
$result3=mysqli_query($conn, "SELECT * FROM voters ");
$data3=mysqli_fetch_all($result3,MYSQLI_ASSOC);

if($_GET['up']){
    $updoc='d-block';
    $id=$_GET['up'];
    $query1="SELECT * FROM votes where id=$id";
    $result1=mysqli_query($conn, $query1);
    $final1=mysqli_fetch_assoc($result1);
    $vid=$final1['vid'];
}
      //Update Party
    if(isset($_POST['update']))
    { $id=$_POST['id'];
        $name=$_POST['name'];
        $description=$_POST['description'];
        if(!$filename){
            $picture=$final1['logo'];
        }
        $update =mysqli_query($conn,"UPDATE `votes` SET `name`='$name',`description`='$description',`logo`='$filename' WHERE id='$id'");
         
      if($update)
      {
        echo "<script> alert('Party Information is Updated  successfully!');window.location.href='votes.php' </script>";
      }
     
        }
 //Delete Partty
 if(isset($_POST['del']))
 {
 $id = $_POST['id'];
 $sql = "DELETE FROM votes WHERE id='$id'";
 $del=mysqli_query($conn, $sql);
     if($del){
         echo "<script> alert('Vote is Deleted Successfully!');window.location.href='votes.php' </script>";
     }
 }
?>
 <!-- Masthead-->
 <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <h3 class="masthead-heading font-weight-light mb-0">Votes Casted</h3>
                <hr class='w-25' style='border:3px solid white'>
            </div>
        </header>
        <div class=" m-5">

     
 <!-- Update Votes details -->
<h4 class='text-primary ml-5 <?php echo $updoc?>'>Edit  Casted Vote Details</h4> 
<div class="row ml-5  <?php echo $updoc?>">
<div class="col-md-8 p-3 border bg-light justify-content-center ">
<form method='POST' enctype="multipart/form-data">
					<div class="col-sm-12">
						<div class="row ">
							<div class="col-sm-6 form-group">
								<label>Party Name</label>
                                <select name="pid" id="">
                               <?php  foreach($data2 as $dat2){ ?>
                                <option class='p-2' value="<?php echo $dat2['id']?>"  <?php  if($dat2['id']==$final1['pid']){ echo "selected";}?> > <?php echo $dat2['name']?></option>
                               <?php }?> </select>
								
							</div>
							
							<div class="col-sm-12 form-group h-25">
                            <label>Voter Name</label>
                            <select name="pid" id="">
                               <?php  foreach($data3 as $dat3){ ?>
                                <option class='p-2' value="<?php echo $dat3['id']?>"  <?php  if($dat3['id']==$final1['vid']){ echo "selected";}?> > <?php echo $dat3['name']?></option>
                               <?php }?> </select>
							</div>	

						</div>						
						<input type="hidden" name="id" value="<?php echo $final1['id']?>">
					<button type="submit" name='update' class="btn btn-lg btn-info mb-2">Update</button>					
					</div>
				</form> </div></div> <br>
 <!-- Show Voters Table -->
        <div class="row justify-content-center">
        <div class="col-md-8 overflow-auto bg-light">
        <table class='table'>
        <tr><th> #</th>
        <th>Voter Name</th>
        <th> Party Name</th>
  
        <th> Action</th>
        </tr>
        
        <?php $i=1; foreach($data as $dat){?>
            <form action="" method="post">
        <tr>
        <td><?php echo $i++ ?></td>
        <td><?php echo $dat['name']?></td>
        <?php $pid=$dat['pid']; $result2=mysqli_query($conn, "SELECT * FROM parties where id='$pid'");
        $data2=mysqli_fetch_assoc($result2);?>
        <td><?php echo $data2['name']?></td>
        <input type="hidden" name='id' value='<?php echo $dat['id']?>'>
        <td><a class='btn btn-info' href="votes.php?up=<?php echo $dat['id']?>">Edit</a> <input type="submit" value="Delete" class='btn btn-danger' name="del" id=""></td>
        </tr> </form>
        <?php }?>
        </table>
        
        
        </div>
        </div></div>
<?php include "footer.php"?>