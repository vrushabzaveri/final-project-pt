<?php include "header.php"?>


<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);


    if ($result->num_rows == 1) {
      $user=$result->fetch_assoc();


       if (password_verify($password, $user['password'])) {
        

          $_SESSION['UserData'] = $user;  
          header("Location: dashboard.php");
           exit();

       }else{
          echo "Invalid username or password!";
       }  

    }else{
      echo "Invalid username or password!";
    }    
  
}


?>

  <div class="container">
    <div class="row">
      <div class="col-sm-3"></div>

      <div class="col-sm-6">

        <div class="row">
          <img src="assets\img\logo.jpg" class="img-responsive">
        </div>
      
        <div class="form-body">
        <h4 class="heading">Login Form</h4>
         
         



        <!-- FORM BODY -->

        <form action='index.php' enctype="multipart/form-data" method="POST">
        <div class="form-group">
               <label for="email">Email address:</label>
               <input type="email" class="form-control" placeholder="Enter email / username" name="email" required>
        </div>
                <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" placeholder="Enter password" name="password" required>
                </div>

        <div class="row">
        <div class="col-sm-3">
            <button type="submit" name="submit_bnt" class="btn btn-warning" style="width:100%">Login</button>
        </div> 


        <div class="col-sm-6"></div>
        <div class="col-sm-3">
            <a href="signup.php"><button type="button" class="btn btn-info" style="width:100%">Signup</button></a>     
        </div>
    </div>
</form>
      

        </div>
        </div>
      </div>
    
    </div>

          <?php
          if (isset($_POST['submit_bnt'])) {
             
              $email = $_POST["email"];
              $password = $_POST["password"];
              $salt = bin2hex(random_bytes(16));
              $hashed_password = password_hash($password . $salt, PASSWORD_DEFAULT);
              $query = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$hashed_password."'";
              $userResult = $conn->query($query);
              $userData  =$userResult->fetch_assoc();
              print_r($userData);exit;

            }
              
          ?>

<?php include "footer.php"?>