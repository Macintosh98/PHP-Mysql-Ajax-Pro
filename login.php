<?php 
    session_start(); 
    if(isset($_POST['submit']))
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydata";

        $U=$_POST['username'];
        $P=$_POST['password'];
        $A=0;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
            $sql = "select * from admin where username='$U' && password='$P'";
            
            if($result=$conn->query($sql))
            {
                if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $action=$row['action'];
                
                if ($action==0){
                    $_SESSION["user"] = "0";
                    header("Location: http://localhost/".dirname($_SERVER['PHP_SELF'])."/view.php");
                }
                else if($action==1){
                    $_SESSION["user"] = "1";
                    header("Location: http://localhost/".dirname($_SERVER['PHP_SELF'])."/view.php");
                }
                else if($action==2){
                    $_SESSION["user"] = "2";
                    header("Location: http://localhost/".dirname($_SERVER['PHP_SELF'])."/insert.php");
                }
                $_SESSION["username"]=$U;
                }
                else
                {
                    ?><script>alert("invalid user");</script><?php
                }
            }
        $conn->close();
    }   
?>
<!DOCTYPE html>
<html>
    <head>    
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="main.css">
    </head>

    <body>
    <div class="container">
        <hr>
          <div class="jumbotron text-center" >
          <h1>Login Page</h1>
          </div>
        <hr><br><br>
            <div class="row justify-content-center align-items-center">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="#" method="POST" autocomplete="off">
                                <div class="form-group">
                                    Username:
                                    <input type="text" class="form-control" name="username">
                                </div>
                                <div class="form-group">
                                    Password:
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </body> 
</html>