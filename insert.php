<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <title>Welcome, to policy planner</title>
  </head>

  <?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydata";

    if ( isset( $_POST['submit'] ) ) 
    {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $action = $_POST['catagary'];
        $Name = $_POST['Name'];
        $MNumber = $_POST['MNumber'];
        $email = $_POST['email'];
        $pan = $_POST['pan'];
        $salary = $_POST['salary'];
        $date = $_POST['date'];
        $status= 1;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
            
        $sql = "INSERT INTO employee (E_name,E_mob,E_email,E_pan,E_sal,E_Jdate,E_status) VALUES ('".$Name."', '".$MNumber."', '".$email."','".$pan."', '".$salary."', '".$date."','".$status."')";
        if ( isset( $_GET['ID'] ) ) 
        {
          $id=$_GET['ID'];
          $sql = "UPDATE employee SET E_name='".$Name."', E_mob='".$MNumber."', E_email='".$email."' ,E_pan='".$pan."' ,E_sal='".$salary."' ,E_Jdate='".$date."' ,E_status='".$status."' WHERE ID='$id'";
        }
        
        if ($conn->query($sql) === TRUE){
            header("Location: http://localhost/".dirname($_SERVER['PHP_SELF'])."/view.php");
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
  ?>

  <body>
    <div class="container">
      <hr>
      <div class="jumbotron text-center">
      <u><h1>Enter Details</h1></u>
      </div>

      <form action="#" method="post">
        <hr>
        <div class="form-group">
              <br>
              <input type="text" placeholder="Username" class="form-control" name="username" value="<?php if ( isset( $_GET['ID'] ) ) echo $row['username']; ?>">
              <br>
              <input type="password" placeholder="Password" class="form-control" name="password" value="<?php if ( isset( $_GET['ID'] ) ) echo $row['password']; ?>">
              <br>
              <input type="text" placeholder="Name" class="form-control" name="Name" value="<?php if ( isset( $_GET['ID'] ) ) echo $row['E_name']; ?>">
              <br>
              <input type="text" placeholder="Mobail Number" class="form-control" name="MNumber" value="<?php if ( isset( $_GET['ID'] ) ) echo $row['E_mob']; ?>">
              <br>
              <input type="email" placeholder="Email address" class="form-control" name="email" value="<?php if ( isset( $_GET['ID'] ) ) echo $row['E_email']; ?>">
              <br>
              <input type="text" placeholder="Pan" class="form-control" name="pan" value="<?php if ( isset( $_GET['ID'] ) ) echo $row['E_pan']; ?>">
              <br>
              <input type="text" placeholder="Salary" class="form-control" name="salary" value="<?php if ( isset( $_GET['ID'] ) ) echo $row['E_sal']; ?>">
              <br>
              <input type="date" placeholder="Join Date" class="form-control" name="date" value="<?php if ( isset( $_GET['ID'] ) ) echo $row['E_Jdate']; ?>">
              <br>
              <select name='catagary' class="form-control">
                <option value="0">Employee</option>
                <option value="1">Manager</option>
                <option value="2">Admin</option>
              </select>
              <br>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <button class="btn btn-light"><a href="view.php">View</a></button>
        <hr>
      </form> 
    </div>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>