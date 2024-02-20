<?php include "header.php" ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $country_code = $_POST['country_code'];
    $flag = isset($_FILES['fileToUpload']['name']) ? $_FILES['fileToUpload']['name'] : "";
    $active = isset($_POST['active']) ? 1 : 0; 

    if ($flag) {
        $target_dir = "assets/Country/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        } elseif ($imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "jpg") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    $sql = "INSERT INTO countries (name, country_code, flag, active) VALUES ('$name', '$country_code', '$flag', '$active')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        header("Location:countries.php"); 
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}



?>
<body>
    <div class="dashboard-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <b><div class="dashboard-heading">Add New Country</div></b>
                </div>
                <div class="col-sm-6 text-right">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="user-info"><?php echo isset($userData['first_name']) && isset($userData['last_name']) ? $userData['first_name'].' '.$userData['last_name'] : '';?></span>
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

            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="formBody">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input type="text" class="form-control" id="Firstname" placeholder="Enter country name" name="name" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="CountryCode">Country Code</label>
                                <input type="text" class="form-control" id="CountryCode" placeholder="Enter country code" name="country_code" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="UploadFlag">Upload Flag</label>
                                <input type="file" class="form-control-file" name="fileToUpload" id="UploadFlag">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="Active">Active</label><br>
                            <label class="radio-inline">
                                <input type="radio" name="active" value="1" checked> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="active" value="0"> No
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success" name="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

<?php include "footer.php"; ?>

