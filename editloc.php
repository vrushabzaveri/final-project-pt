<?php include "header.php"; ?>
 <?php 

  $locationid = $_GET['id'];
  $query = "SELECT * FROM locations where id = ".$locationid."";
  $result = $conn->query($query);
  $row=$result->fetch_assoc();

?>
<div class="dashboard-container">
<div class="container">

    <div class="row">

        <div class="col-sm-6">
            <b><div class="dashboard-heading">Edit Location</div></b>   
        </div> 

        <div class="col-sm-6 pull-right">
            <div class="row">
                  <div class="col-sm-6 text-right">
                      <span class="user-info"><?php echo $userData['first_name'].' '.$userData['last_name'];?></span>
                      
                  </div>
                  <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4" style="padding-right: 0px;">
                              <a href="location.php?id=<?php echo $row["id"]; ?>"><button type="button" class="btn btn-success addNewBtn">Back</button></a>
                          </div>
                          <div class="col-sm-4" style="padding-right: 0px;">
                              <a href="dashboard.php"><button type="button" class="btn btn-info addNewBtn" style="margin-right: 5px;">Home</button></a>
                          </div>
                          <div class="col-sm-4">
                              <a href="logout.php"><button type="button" class="btn btn-danger addNewBtn">Logout</button></a>
                          </div>
                    </div>    
                  </div>
                        
            </div>
            

            
        </div>
    </div>




 <!-- New user Form  -->
 <div class="formBody">
 <form action='' method="POST"> 
 <div class="row">
  <div class="col-sm-3">
      <div class="form-group">
          <label for="name">name</label>
          <input type="text" class="form-control" id="name" placeholder="Enter firstname" name="fname" value="<?php echo $row["name"];?>" required>
       </div>
    </div>
    <div class="col-sm-4">
      <?php 
        $checked = ($row["active"] == 1) ? 'checked' : '';  
        $unchecked = ($row["active"] != 1) ? 'checked' : '';

      ?>
      <label for="Active">Active</label><br>
      <label class="radio-inline">
        <input type="radio" name="active" value='1' <?php echo $checked;?>>Yes
      </label>
      <label class="radio-inline">
        <input type="radio" value='0' name="active" <?php echo $unchecked;?>>No
      </label>
      </div>
      <div class="row">
  </div>
</div>
<hr>
<div class="row">
  <div class="col-sm-12">
     <a href="viewloc.php"><button type="submit" class="btn btn-success" name="submit_form">Submit</button></a>
  </div>
 </div>

 </form>
</div>
</div>

 <?php 

 if(isset($_POST['submit_form'])){

      
  $name = (!empty($_POST['fname'])) ? $_POST['fname'] : '';
  $active  = (!empty($_POST['active'])) ? $_POST['active'] : '';

  $update = "UPDATE locations SET name='".$name."', active='".$active."' WHERE id ='".$locationid."'";

    if(mysqli_query($conn, $update)){  
        $msg = "Data stored Successfully";

        header("Location:location.php");
    exit();

      }
 }
 ?>




   