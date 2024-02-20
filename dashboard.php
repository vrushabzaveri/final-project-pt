<?php include "header.php"?>
<?php if(isset($_SESSION['UserData'])){ ?>
<div class="dashboard-container">
<div class="container">
<div class="row">
	<div class="col-sm-6">
		<b><div class="dashboard-heading">DASHBOARD</div></b>
	</div>
	<div class="col-sm-6 text-right">
		<span class="user-info"><?php echo $userData['first_name'].' '.$userData['last_name'];?></span>
		 <a href="logout.php"><button type="button" class="btn btn-danger">Logout</button></a>
	</div>
</div>	
</div>

	<hr>
<div class="container">
	<div class="row">
		<?php 
			
			$sql = "SELECT COUNT(*) AS Users FROM users";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$count = $row['Users'];
		
		?>
		<div class="col-md-3">
			<a href="userlis.php">
			<div class="card2">
				<div class="card-body">
					<b><span>Total Users</span><br></b>
					<b><span>(<?php echo $count; ?>)</span></b>
				</div>
			</div>
			</a>	
		</div>

		<div class="col-md-3">
			<a href="countries.php">
			<div class="card3">
				<div class="card-body">
						<?php 
			
						$sql = "SELECT COUNT(*) AS countries FROM countries";
						$result = $conn->query($sql);
						$row = $result->fetch_assoc();
						$count = $row['countries'];
		
						?>
					 <b><span>Countries</span></b><br>
					 <b><span>(<?php echo $count; ?>)</span></b>
					
				</div>
			</div>
			</a>
		</div>

		<div class="col-md-3">
			<a href="location.php">
			<div class="card1">
				<div class="card-body">

					<?php
            					$sql = "SELECT COUNT(*) AS locations FROM locations";
								$result = $conn->query($sql);
								$row = $result->fetch_assoc();
								$count = $row['locations'];
     				 ?> 
     				 
				 	 <b><span>Cities</span><br></b>
					<b><span>(<?php echo $count; ?>)</span></b>

				</div>
			</div>
			</a>
		</div>
		
			

		<div class="col-md-3">
			<a href="http://localhost/phpmyadmin/index.php">
			<div class="card4">
				<div class="card-body">
					<b><span>phpMyAdmin</span></b>
				</div>
			</div>	
		</a>
		</div>	
</div>
</div>
 <?php include "footer.php" ?>
<?php }else{  header('location: index.php');} ?>
