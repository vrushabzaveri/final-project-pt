<?php include "header.php"; ?>
<?php if(isset($_SESSION['UserData'])){ ?>

<?php 
  $userId = $_GET['id'];
  $query = "SELECT * FROM users where id = ".$userId."";
  $result = $conn->query($query);
  $row=$result->fetch_assoc();
 ?>

<?php
  $userId = $_GET['id'];
  $query = "SELECT * FROM users where id = ".$userId."";
?>

<div class="dashboard-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-6">
                <b><div class="dashboard-heading">Update User Form</div></b>
            </div>



 <div class="col-sm-6 text-right">
          <div class="row">
          <div class="col-sm-6">
          <span class="user-info"><?php echo $userData['first_name'].' '.$userData['last_name'];?></span>
          </div>  
          <div class="col-sm-6">
          <div class="row">
          <div class="col-sm-4">
          <a href="userlis.php"><button type="button" class="btn btn-success addNewBtn">Back</button></a>
           </div>
              <div class="col-sm-4" style="padding-right: 0px;">
          <a href="dashboard.php"><button type="button" class="btn btn-info addNewBtn">Home</button></a>
          </div>
          <div class="col-sm-4">
          <a href="logout.php"><button type="button" class="btn btn-danger addNewBtn">Logout</button></a>
          </div>

  </div> 
 </div>
</div>
</div>
</div>


 <?php 

 if(isset($_POST['submit_form'])){

  //var_dump($_FILES);die;

  $firstName = (!empty($_POST['fname'])) ? $_POST['fname'] : '';
  $lastName = (!empty($_POST['lname'])) ? $_POST['lname'] : '';
  $email = (!empty($_POST['email'])) ? $_POST['email'] : '';
  $Contact = (!empty($_POST['Contact'])) ? $_POST['Contact'] : '';
  $dateofbirth = (!empty($_POST['dateofbirth'])) ? $_POST['dateofbirth'] : '';
  $location_id = (!empty($_POST['location_id'])) ? $_POST['location_id'] : '';
  $imageData = (!empty($_FILES["fileToUpload"]["name"])) ? basename($_FILES["fileToUpload"]["name"]) : '';
  
  $country_id = (!empty($_POST['country_id'])) ? $_POST['country_id'] : '';
  $password = (!empty($_POST['password'])) ? $_POST['password'] : '';
  $passwordHash = password_hash($password, PASSWORD_BCRYPT);
  $active  = (!empty($_POST['active'])) ? $_POST['active'] : '';


    // Check if a new image was uploaded
    $image = '';
    if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "assets/Users/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $image = basename($_FILES["fileToUpload"]["name"]);
        }
    }

    // If no new image was uploaded, keep the existing one
    if(empty($image)) {
        $displayImageQuery = "SELECT * FROM users WHERE id = ".$userId."";
        $displayImageResult = $conn->query($displayImageQuery);
        $imageData = $displayImageResult->fetch_assoc();
        $image = $imageData['img_file'];
    }



 $update = "UPDATE users SET first_name='".$firstName."', last_name='".$lastName."', email='".$email."', contact_number='".$Contact."', dob='".$dateofbirth."', country_id='".$country_id."', location_id='".$location_id."', password='".$passwordHash."', active='".$active."',img_file='".$image."' WHERE id ='".$userId."'";



    if(mysqli_query($conn, $update)){  
        $msg = "Data stored Successfully";
        header("Location:userlis.php");
    exit();
      }
 }
 ?>

 <!-- New user Form  -->
 <div class="formBody">
 <form action='#' method="POST" enctype="multipart/form-data"> 
 <div class="row">
  <div class="col-sm-3">
      <div class="form-group">
          <label for="Firstname">Firstname</label>
          <input type="text" class="form-control" id="Firstname" placeholder="Enter firstname" name="fname" value="<?php echo $row["first_name"];?>" required>
       </div>
    </div>
    <div class="col-sm-3">
       <div class="form-group">
          <label for="Lastname">Lastname</label>
          <input type="text" class="form-control" id="Lastname" placeholder="Enter lastname" name="lname" value="<?php echo $row["last_name"];?>" required>
        </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
          <label for="Contact">Contact</label>
          <input type="number" class="form-control" id="Contact" placeholder="Enter contact" name="Contact" value="<?php echo $row["contact_number"];?>" required>
      </div>
    </div>

    <div class="col-sm-3">
      <div class="form-group">
          <label for="Dob">Date of Birth:</label>
          <input type="date" class="form-control" id="Date" placeholder="Enter DoB" name="dateofbirth" value="<?php echo $row["dob"];?>" required>
      </div>
    </div>
    <hr>
  </div>
 <div class="row">  
  <div class="col-sm-3">
      <?php 
        $query = "SELECT * FROM countries WHERE active = 1";
        $result = $conn->query($query);

      ?>
      <div class="form-group">
        <label for="city">Choose a Countries:</label>
          <select name="country_id" id="Country_ID" class="form-control">
            <option value="">Select</option>

            <!-- dynamic -->
            <?php  while ($Country_ID = $result->fetch_assoc()) {

                $selected = ($row["country_id"] == $Country_ID['id']) ? 'selected' : '';
            
            ?>
              <option value="<?php echo ucfirst($Country_ID['id']);?>" <?php echo $selected;?>><?php echo ucfirst($Country_ID['name']);?></option>
            <?php } ?>

          </select>
      </div>
    </div>
     <div class="col-sm-3">
      <?php 
        $query = "SELECT * FROM locations WHERE active = 1";
        $result = $conn->query($query);

      ?>
      <div class="form-group">
        <label for="city">Choose a Location:</label>
          <select name="location_id" id="location_id" class="form-control">
            <option value="">Select</option>

            <!-- dynamic -->
            <?php  while ($location = $result->fetch_assoc()) {

                $selected = ($row["location_id"] == $location['id']) ? 'selected' : '';
            
            ?>
              <option value="<?php echo ucfirst($location['id']);?>" <?php echo $selected;?>><?php echo ucfirst($location['name']);?></option>
            <?php } ?>

          </select>
      </div>
    </div>
    
<div class="col-sm-3">
    <div class="form-group">
        <div id="imagePreview">
            <?php 
            $displayImage = "SELECT * FROM users WHERE id = ".$userId."";
            $runImage = $conn->query($displayImage);
            $imageData = $runImage->fetch_assoc();
            ?>
            <img src="assets/Users/<?php echo $imageData['img_file']; ?>" alt="User Image" style="max-width: 100px;">
            <p><?php echo $imageData['img_file']; ?></p>
        </div>
        <label for="uploadimage">Upload image</label>
        <input type="file" class="form-control-file" name="fileToUpload" id="uploadimage" onchange="previewImage(event)">
    </div>
</div>

    <div class="col-sm-3">


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
  </div>
  <hr>

                   <!-- username -->
<div class="row">
<div class="col-sm-4">
<label for="username">username</label>
<input type="email" class="form-control" value="<?php echo $row["email"];?>" id="email" placeholder="Enter email / username" name="email" required>
</div>

<!-- password -->

<div class="col-sm-4">
<div class="form-group">
<label for="password">password</label>

<input type="password" class="form-control" value="<?php echo $row["password"]?>" id="password" placeholder="Enter password" name="password" required>

</div>
</div>
</div>

</div>

 <div class="row">
  <div class="col-sm-12">
     <button type="submit" class="btn btn-success" name="submit_form">Submit</button>
  </div>
 </div>

 </form>
</div>
</div>

<script>
function previewImage(event) {
    var input = event.target;
    var imagePreview = document.getElementById('imagePreview');
    var img = imagePreview.querySelector('img');
    var p = imagePreview.querySelector('p');
    img.src = URL.createObjectURL(input.files[0]);
    p.textContent = input.files[0].name;
}
</script>

<?php }else{  header('location: index.php');} ?>
