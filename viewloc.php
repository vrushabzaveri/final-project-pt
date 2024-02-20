<?php include("header.php"); 

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

 $query = "SELECT * FROM locations WHERE id = ".$userId."";
    $result = $conn->query($query);
  }


     if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
      }
?>

<body>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-6">
                        <h1>View Location Form</h1>
                    </div>
                    <div class="col-sm-6 col-xs-6 text-right">
                    <a href="location.php"><button type="button" class="btn btn-success btn-md" float-right style="margin-top: 15px">Back</button></a>
                    <a href="dashboard.php"><button type="button" class="btn btn-info btn-md" float-right style="margin-top: 15px">Home</button></a>
                    </div>

                    <div class="col-sm-12">
                        <table class="table table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <th class="success">name</th>
                                    <td><?php echo $user['name']; ?></td>
                                </tr>

                                <tr>
                                    <th class="success">active</th>
                                    <td><?php echo ($user['active'] == 1) ? 'Yes' : 'No'; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
        </body>
