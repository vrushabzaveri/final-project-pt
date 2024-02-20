<?php include "header.php"?>
<?php if(isset($_SESSION['UserData'])){ ?>
<div class="dashboard-container">
<div class="container">

    <div class="row">

        <div class="col-sm-6"><b><div class="dashboard-heading">User Listing</div></b></div> 
        
        <div class="col-sm-6 pull-right">
            <div class="row">

                  <div class="col-sm-6 text-right">
                      <span class="user-info"><?php echo $userData['first_name'].' '.$userData['last_name'];?></span>
                      
                  </div>
                  <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4" style="padding-right: 0px;">
                              <a href="addnewuser.php"><button type="button" class="btn btn-success addNewBtn">Add New</button></a>
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

    <!-- User Table -->
    
    <div class="row">
        <div class="col-sm-12">

            <?php
                  $sqlQuery = "SELECT * FROM users";
                  $result = $conn->query($sqlQuery);
                  if ($result->num_rows > 0) {
            ?> 

            <table class="table table-bordered" style="border-color:black;">
                <thead>
                    <tr>
                        <th>SR</th>
                        <th scope="col">Flag</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact</th>
                        <th scope="col">DOB</th>
                        <th scope="col">Country</th>
                        <th scope="col">Location</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sr = 0;
                    while ($row = $result->fetch_assoc()) {

                        $sr++;

                        $imageFile = "assets/Users/".$row['img_file'];  
                        $name = $row["first_name"] . ' ' . $row["last_name"] ;

 
                        

                    ?> 
                    <tr>
                        <td><?php echo $sr; ?></td>
                        <td><img src="<?php echo $imageFile ?>"  class="imageicon"></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $row["email"];?></td>
                        <td><?php echo $row["contact_number"]; ?></td>
                        <td><?php echo $row["dob"]; ?></td>


                        
                        <td>
                            <?php 

                            $country_id = $row["country_id"];
                            
                            $querylocation = "SELECT * FROM  countries WHERE id = ".$country_id."";
                            $result1 = $conn->query($querylocation);   
                            $country = $result1->fetch_assoc();

                            echo (!empty($country['name'])) ? $country['name'] : '---'; ; ?>
                        </td> 

                        <td>
                         
                          <?php 

                            $locationId = $row["location_id"];
                            
                            $querylocation = "SELECT * FROM  locations WHERE id = ".$locationId."";
                            $result1 = $conn->query($querylocation);
                            $location = $result1->fetch_assoc();

                            echo (!empty($location['name'])) ? $location['name'] : '---'; ; ?>
                        </td>

                        <td><?php echo $row["active"]; ?></td>
                        
                        <td>
                            <a href="viewuser.php?id=<?php echo $row["id"]; ?>"><input type="button" value="View" class="btn btn-success btn-sm"></a> 
                            <a href="user_update.php?id=<?php echo $row["id"]; ?>"><input type="button" value="Edit" class="btn btn-info btn-sm"></a>
                        </td>

                    </tr>
                    <?php } ?>  
                </tbody>
            </table>
            <?php } else { echo 'Empty Table!'; }?>
        </div>
    </div>
</div>  
<?php include "footer.php";?>
<?php } else{  header('location: index.php');} ?>
