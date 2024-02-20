<?php include "header.php"?>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <b><div class="dashboard-heading">Cities Listings</div></b>   
        </div> 
        <div class="col-sm-6 pull-right">
            <div class="row">
                <div class="col-sm-6 text-right">
                    <span class="user-info"><?php echo $userData['first_name'].' '.$userData['last_name'];?></span>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4" style="padding-right: 10px;">
                           <a href="addnewlocation.php"><button type="button" class="btn btn-success  addNewBtn">Add New </button></a>
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
   
    <div class="row">
        <div class="col-sm-12">
            <?php
            $sqlQuery = "SELECT * FROM locations";
            $result = $conn->query($sqlQuery);
            if ($result->num_rows > 0) {
            ?>
            <table class="table table-bordered" style="border-color:black;">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th scope="col">country</th>
                        <th scope="col">name</th>
                        <th scope="col">active</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $id = 0;
                    while($row = $result->fetch_assoc()) {
                        $id++;
                        $name = $row["name"];
                        $country_id = $row["country_id"];
                        $querylocation = "SELECT * FROM countries WHERE id = ".$country_id."";
                        $result1 = $conn->query($querylocation);
                        if($result1->num_rows > 0) {
                            $country = $result1->fetch_assoc();
                            $country_name = $country['name'];
                        } else {
                            $country_name = '---';
                        }
                        ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $country_name; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo ($row['active'] == 1) ? 'Yes' : 'No'; ?></td>
                            <td>
                                <!-- View -->
                                <a href="viewloc.php?id=<?php echo $row["id"]; ?>"><input type="button" value="View" class="btn btn-success btn-sm"></a> 
                                <!-- Update -->
                                <a href="editloc.php?id=<?php echo $row["id"]; ?>"><input type="button" value="Edit" class="btn btn-info btn-sm"></a>
                            </td> 
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php }
            else{ echo 'no data'; }?>
        </div>
    </div>
</div>  

<?php include "footer.php"?>
