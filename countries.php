<?php include "header.php"; ?>
<?php if(isset($_SESSION['UserData'])){ ?>
<?php

    $userId = isset($_GET['id']) ? $_GET['id'] : 0;
    $query = "SELECT * FROM users where id = ".$userId."";
    $userId = intval($userId);

    if($userId > 0) {
       
        $query = "SELECT * FROM users WHERE id = " . $userId;

        $result = mysqli_query($conn, $query);

        if ($result) {
            $userData = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } 

 ?>
    

<div class="dashboard-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <b><div class="dashboard-heading">Countries Listings</div></b>
            </div>
            <div class="col-sm-6 text-right">
                <div class="row">
                    <div class="col-sm-6">
                            <span class="user-info"><?php echo $userData['first_name'].' '.$userData['last_name'];?></span>

                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="addcountry.php"><button type="button" class="btn btn-success addNewBtn">Add New</button></a>
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

<!-- User Table -->
<div class="container">
    <div class="col-sm-12">
        <table class="table table-bordered" style="border-color:black;">
            <thead>
                <tr>
                    <th>Sr</th>
                    <th scope="col">Name</th>
                    <th scope="col">Country Code</th>
                    <th scope="col">Active</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>

               <?php
                    $sql = "SELECT * FROM countries";
                    $result_outer = mysqli_query($conn, $sql);

                    if ($result_outer) {
                        if (mysqli_num_rows($result_outer) > 0) {
                            $count = 1;

                            while ($row_outer = mysqli_fetch_assoc($result_outer)) {

                                $imagePath = 'assets/Country/'.$row_outer['flag'];

                                echo "<tr>";
                                echo "<td>" . $count . "</td>";
                                echo "<td>" .'<img src='.$imagePath.' class="flagIcon"> ' .$row_outer["name"] . "</td>";
                                echo "<td>" . $row_outer["country_code"] . "</td>";
                                echo "<td>" . ($row_outer["active"] == 1 ? 'Yes' : 'No') . "</td>";
                                echo "<td>
                                        <a href='viewcountry.php?id=" . $row_outer["id"] . "'><input type='button' value='View' class='btn btn-success btn-sm'></a>
                                        <a href='editcountry.php?id=" . $row_outer["id"] . "'><input type='button' value='Edit' class='btn btn-info btn-sm'></a>
                                      </td>";
                                echo "</tr>";
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='5'>No countries found</td></tr>";
                        }
                    } 
?>




            

            </tbody>
        </table>
    </div>
</div>

<?php include "footer.php"; ?>
<?php } else{  header('location: index.php');} ?>