<?php include("header.php"); ?> 
<?php 
if(isset($_SESSION['UserData'])){ 
    $name = $country_code = $flagImageUrl = $active = '';

    if (isset($_GET['id'])) {
        $userId = $_GET['id'];
        $query = "SELECT * FROM countries WHERE id = $userId";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $name = $user['name'];
            $country_code = $user['country_code']; 
            $flagImageUrl = "assets/Users/".$user['flag']; 
            $active = $user['active']; 
        }
    }

?>

<body>
    <div class="dashboard-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xs-6">
                    <b><div class="dashboard-heading">View Country</div></b>
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
        </div>
    </div>

    <hr>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-hover table-bordered">
                    <tbody>
                        <tr>
                            <th class="success">Name</th>
                            <td><?php echo $name; ?></td>
                        </tr>
                        <tr>
                            <th class="success">Country Code</th>
                            <td><?php echo $country_code; ?></td>
                        </tr>
                        <tr>
                            <th class="success">Flag Image</th>
                            <td><img src="<?php echo $flagImageUrl; ?>" class="imagefile"></td>
                        </tr>
                        <tr>
                            <th class="success">Active</th>
                            <td><?php echo $active ? 'Yes' : 'No'; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<?php }else{  header('location: index.php');} ?>