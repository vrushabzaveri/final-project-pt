<?php include "header.php"; ?>
<?php 
if(isset($_SESSION['UserData'])) { 
    $name = $country_code = $flag = $active = '';

    if (isset($_GET['id'])) {
        $userId = $_GET['id'];
        $query = "SELECT * FROM countries WHERE id = $userId";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $name = $user['name'];
            $country_code = $user['country_code']; 
            $flag = $user['flag'];
            $flagImageUrl = "assets/Users/".$user['flag']; 
            $active = $user['active']; 
        }
    }


if(isset($_POST['submit_form'])) {
    //var_dump($_FILES);die;
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $country_code = mysqli_real_escape_string($conn, $_POST['country_code']);
    $active = $_POST['active'];

    if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "assets/Users/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $flag = basename($_FILES["fileToUpload"]["name"]); 
    }

    $update = "UPDATE countries SET name='$name', country_code='$country_code', flag='$flag', active='$active' WHERE id=$userId";

    if(mysqli_query($conn, $update)){  
        $msg = "Data stored Successfully";
        header("Location:countries.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<div class="dashboard-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-6">
                <b><div class="dashboard-heading">Update Country</div></b>
            </div>
            <div class="col-sm-6 text-right">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="user-info"><?php echo $userData['first_name'].' '.$userData['last_name'];?></span>
                    </div>  
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="countries.php"><button type="button" class="btn btn-success addNewBtn">Back</button></a>
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

        <div class="dashboard-container">
            <div class="container">
                <div class="formBody">
                    <form action='' method="POST" enctype="multipart/form-data"> 
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="Name">Name</label>
                                    <input type="text" class="form-control" id="Firstname" placeholder="Enter firstname" name="name" value="<?php echo isset($name) ? $name : ''; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="Lastname">Code</label>
                                    <input type="text" class="form-control" id="Lastname" placeholder="Enter lastname" name="country_code" value="<?php echo isset($country_code) ? $country_code : ''; ?>" required>
                                </div>
                            </div> 
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="uploading">Upload image</label>
                                    <input type="file" class="form-control-file" name="fileToUpload" id="uploadimage">
                                </div>
                                
                                <div class="form-group">
                                    <label for="imageName">Image Name</label>
                                    <div id="imageName"><?php echo $flag; ?></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <label for="Active">Active</label><br>
                                <label class="radio-inline">
                                    <input type="radio" name="active" value='1' <?php echo isset($active) && $active == 1 ? 'checked' : ''; ?>>Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value='0' name="active" <?php echo isset($active) && $active == 0 ? 'checked' : ''; ?>>No
                                </label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success" name="submit_form">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
<?php }else{  header('location: index.php');} ?>
