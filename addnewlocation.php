<?php include "header.php"; ?>
<div class="dashboard-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <b><div class="dashboard-heading">Add New City</div></b>   </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6 text-right">
                        <span class="user-info"><?php echo $userData['first_name'].' '.$userData['last_name'];?></span>
                    </div>

                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4" style="padding-right: 0px;">
                                <a href="location.php"><button type="button" class="btn btn-success addNewBtn">Back</button></a>
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



 <!-- New location Form  -->
 <div class="formBody">
 <form action='addnewlocation.php' method="POST">	

 	<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="countryid">Country</label>
            <select class="form-control" id="countryid" name="country_id" required>
                <option value="">Select Country</option>
						<!-- for dyanmic dropdown use this query -->
                <?php
                $sql = "SELECT * FROM countries";
								$result = mysqli_query($conn, $sql);

							
								if ($result) {
								    while ($row = mysqli_fetch_assoc($result)) {
								        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
								    }
								} else {
								    echo '<option value="">No countries found</option>';
								}
?>

            </select>
        </div>
    </div>

 <div class="row">
 	<div class="col-sm-3">
  		<div class="form-group">
	        <label for="name">name</label>
	        <input type="text" class="form-control" id="name" placeholder="Enter firstname" name="fname" required>
	     </div>
  	</div>


  	<div class="col-sm-3">
  		<label for="Active">active</label><br>
  		<label class="radio-inline">
	      <input type="radio" name="active" value='1' checked>Yes
	    </label>
	    <label class="radio-inline">
	      <input type="radio" value='0' name="active">No
	    </label>
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


<!-- add data into database -->
<?php 

 if(isset($_POST['submit_form'])){
 		$country_id  = (!empty($_POST['country_id'])) ? $_POST['country_id'] : '';
 		$name = (!empty($_POST['fname'])) ? $_POST['fname'] : '';
 		$active  = (!empty($_POST['active'])) ? $_POST['active'] : '';
 		// echo $active;

 		$insert = "INSERT INTO locations (country_id, name, active) VALUES ('$country_id','$name','$active')";
 		if(mysqli_query($conn, $insert)){  
		    $msg = "Data stored Successfully";
		    header("Location:location.php");
		  }
 }
?>                                                                               
