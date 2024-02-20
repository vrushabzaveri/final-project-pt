<?php include("header.php"); ?>
<?php if(isset($_SESSION['UserData'])){ 

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    

    $query = "SELECT * FROM users WHERE id = $userId";
    $result = $conn->query($query);
}
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $imagePath = "assets/Users/".$user['img_file'];
}
?>

<body>
    <div class="dashboard-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-6">
                <b><div class="dashboard-heading">View User Form</div></b>
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
    </div>
</div>

    <hr>
    <div class="container">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover table-bordered">
                <tbody>
                    <tr>
                        <th class="success">First name</th>
                        <td><?php echo $user['first_name']; ?></td>
                    </tr>
                    <tr>
                        <th class="success">Last name</th>
                        <td><?php echo $user['last_name']; ?></td>
                    </tr>
                    <tr>
                        <th class="success">Email</th>
                        <td><?php echo $user['email']; ?></td>
                    </tr>
                    <tr>
                        <th class="success">Contact</th>
                        <td><?php echo $user['contact_number']; ?></td>
                    </tr>
                    <tr>
                        <th class="success">Date of Birth</th>
                        <td><?php echo $user['dob']; ?></td>
                    </tr>

                     <tr>
                        <th class="success">Country</th>
                        <td>
                          <?php 

                            $country_id = $user["country_id"];
                            
                            $querylocation = "SELECT * FROM  countries WHERE id = ".$country_id."";
                            $result1 = $conn->query($querylocation);   
                            $country = $result1->fetch_assoc();

                            echo (!empty($country['name'])) ? $country['name'] : '---'; ?>


                    </td>
                    </tr>

                    <tr>
                        <th class="success">City</th>
                        <td>
                            <?php 
                                $locationId = $user["location_id"];
                                $querylocation = "SELECT * FROM locations WHERE id = $locationId";
                                $result1 = $conn->query($querylocation);
                                $location = $result1->fetch_assoc();
                                echo (!empty($location['name'])) ? $location['name'] : '---';
                            ?>                                                        
                        </td>
                    </tr>
                    <tr>
                        <th class="success">Active</th>
                        <td><?php echo ($user['active'] == 1) ? 'Yes' : 'No'; ?></td>
                    </tr>
                    <tr>
                        <th class="success">Username</th>
                        <td><?php echo $user['email'] ?></td>
                    </tr>
                    <tr>
                        <th class="success">Password</th>
                        <td><?php echo $user['password'] ?></td>
                    </tr>
                    <tr>
                        <th class="success">Image</th>
                        <td><img src="<?php echo $imagePath; ?>" class="imagefile"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

<?php }else{  header('location: index.php');} ?>