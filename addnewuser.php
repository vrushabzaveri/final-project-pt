<?php include "header.php"; ?>
<?php if(isset($_SESSION['UserData'])){ ?>
<div class="dashboard-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <b><div class="dashboard-heading">Add New User</div></b>   </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6 text-right">
                        <span class="user-info"><?php echo $userData['first_name'].' '.$userData['last_name'];?></span>
                    </div>

                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4" style="padding-right: 0px;">
                                <a href="userlis.php"><button type="button" class="btn btn-success addNewBtn">Back</button></a>
                            </div>
                            <div class="col-sm-4" style="padding-right: 0px;">
                                <a href="dashboard.php"><button type="button" class="btn btn-info  addNewBtn">Home</button></a>
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
    <?php

    if (isset($_POST['submit_form'])) {
    $statusMsg = '';
    $target_dir = "assets/Users/";

    $first_name = (!empty($_POST['first_name'])) ? $_POST['first_name'] : '';
    $last_name = (!empty($_POST['last_name'])) ? $_POST['last_name'] : '';
    $country_id = (!empty($_POST['country_id'])) ? $_POST['country_id'] : '';
    $contact_number = (!empty($_POST['contact_number'])) ? $_POST['contact_number'] : '';
    $dob = (!empty($_POST['dob'])) ? $_POST['dob'] : '';
    $location_id = (!empty($_POST['location_id'])) ? $_POST['location_id'] : '';
    $active = (!empty($_POST['active'])) ? $_POST['active'] : '';
    $email = (!empty($_POST['email'])) ? $_POST['email'] : '';
    $password = (!empty($_POST['password'])) ? $_POST['password'] : '';

    $fileName = basename($_FILES["fileToUpload"]["name"]); 
    $targetFilePath = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

    $image = '';
    if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "assets/Users/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $image = basename($_FILES["fileToUpload"]["name"]);
        }
    }

    
    if(empty($image)) {
        $displayImageQuery = "SELECT * FROM users WHERE id = ".$userId."";
        $displayImageResult = $conn->query($displayImageQuery);
        $imageData = $displayImageResult->fetch_assoc();
        $image = $imageData['img_file'];
    }

    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
            // Image uploaded successfully
            $statusMsg = "File uploaded successfully.";
        } else {
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    } 
    echo $statusMsg; 
}
?>

    <div class="formBody">
        <form action='addnewuser.php' enctype="multipart/form-data" method="POST">	
            <div class="row">
                <!-- Form fields -->
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="Firstname">Firstname</label>
                        <input type="text" class="form-control" id="Firstname" placeholder="Enter firstname" name="first_name" required>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="Lastname">Lastname</label>
                        <input type="text" class="form-control" id="Lastname" placeholder="Enter lastname" name="last_name" required>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="Contact">Contact</label>
                        <input type="number" class="form-control" id="Contact" placeholder="Enter contact" name="contact_number" required>
                    </div>
                </div>
                <div class="row">
                <!-- Form fields -->
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="Dob">Date of Birth:</label>
                        <input type="date" class="form-control" id="Date" placeholder="Enter DoB" name="dob" required>
                    </div>
                </div>
                
                
            </div>
            <hr>
                <div class="col-sm-3">
                    <?php 
                        $query = "SELECT * FROM countries WHERE active = 1";
                        $result = $conn->query($query);
                    ?>
                    <div class="form-group">
                        <label for="city">Choose a Country:</label>
                        <select name="country_id" id="Country_ID" class="form-control">
                            <option value="">Select</option>
                            <!-- dynamic -->
                            <?php  while ($row = $result->fetch_assoc()) { ?>
                                <option value="<?php echo ucfirst($row['id']); ?>"><?php echo ucfirst($row['name']); ?></option>
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
                            <?php  while ($row = $result->fetch_assoc()) { ?>
                                <option value="<?php echo ucfirst($row['id']); ?>"><?php echo ucfirst($row['name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <div id="imagePreview">
                            <img src="" alt="User Image" style="max-width: 100px;">
                        </div>
                        <label for="uploading">Upload image</label>
                        <input type="file" class="form-control-file" name= "fileToUpload"  id="uploadimage" onchange="previewImage(event)">
                        <span id="uploadimage"><?php echo (!empty($_GET['file'])) ? $_GET['file'] : ''; ?></span>
                    </div>	
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="Active">Active</label>
                        <label class="radio-inline">
                            <input type="radio" name="active" value='1' checked>Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" value='0' name="active">No
                        </label>
                    </div>	
                </div>
            </div>
            <hr>

            <!-- username -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="username">Email / Username</label>
                        <input type="email" class="form-control" id="username" placeholder="Enter email / username" name="email" required>
                    </div>
                
                    <!-- password -->
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required>
                    </div>
                </div>
            </div>
        </div>

            <hr>

            <div class="row">
                
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success" name="submit_form">Submit</button>
                    <button type="reset" class="btn btn-warning" name="">Reset</button>
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
<?php }else{  header('location: index.php'); } ?>


