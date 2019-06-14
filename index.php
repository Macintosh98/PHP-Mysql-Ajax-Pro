<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Welcome, to policy planner</title>
  </head>

  <?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydata";

    if ( isset( $_POST['submit'] ) ) 
    {
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


    if ( isset( $_GET['ID'] ) ) 
    {
        $id=$_GET['ID'];
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT * FROM employee where ID=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); 
        } else {
            echo "0 results";
        }
        $conn->close();
    }
  ?>

  <body>
    <div class="container">
      
      <div class="jumbotron text-center" style="margin-bottom:0">
      <h1>Welcome To Policy Planner</h1>
      <p>Enter employee details</p>
      </div>

      <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>    
          </ul>
        </div>  
      </nav>

      <form action="#" method="post">
        <div class="form-group">
              <label>Name:</label>
              <input type="text" class="form-control" name="Name" value="<?php if ( isset( $_GET['ID'] ) ) echo $row['E_name']; ?>">
            
              <label>Mobail Number:</label>
              <input type="text" class="form-control" name="MNumber" value="<?php if ( isset( $_GET['ID'] ) ) echo $row['E_mob']; ?>">

              <label>Email address:</label>
              <input type="email" class="form-control" name="email" value="<?php if ( isset( $_GET['ID'] ) ) echo $row['E_email']; ?>">
          
              <label>Pan:</label>
              <input type="text" class="form-control" name="pan" value="<?php if ( isset( $_GET['ID'] ) ) echo $row['E_pan']; ?>">
        
              <label>Salary:</label>
              <input type="text" class="form-control" name="salary" value="<?php if ( isset( $_GET['ID'] ) ) echo $row['E_sal']; ?>">
          
              <label>Join Date:</label>
              <input type="date" class="form-control" name="date" value="<?php if ( isset( $_GET['ID'] ) ) echo $row['E_Jdate']; ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <button class="btn btn-light"><a href="view.php">View</a></button>
      </form> 

      <div class="jumbotron text-center" style="margin-bottom:0">
        <p>Footer</p>
      </div>

    </div>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>