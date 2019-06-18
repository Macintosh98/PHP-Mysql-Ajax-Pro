<?php
session_start();
$id=$_POST['ID'];
if ( isset( $_POST['ID'] ) )
{ 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydata";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    if ( isset( $_POST['N'] ) )
    {
        $Name = $_POST['N'];
        $MNumber = $_POST['M'];
        $email = $_POST['E'];
        $pan = $_POST['P'];
        $salary = $_POST['S'];
        $date = $_POST['J'];
        $status= 1;

        if($_SESSION['user']=="0"){
            $sql = "UPDATE employee SET name='".$Name."', mob='".$MNumber."', email='".$email."' ,pan='".$pan."' ,sal='".$salary."' ,Jdate='".$date."' ,status='".$status."' WHERE ID='$id'";
        }else if ($_SESSION['user']=="1"){
            $sql = "UPDATE manager SET name='".$Name."', mob='".$MNumber."', email='".$email."' ,pan='".$pan."' ,sal='".$salary."' ,Jdate='".$date."' ,status='".$status."' WHERE ID='$id'";
        }

        if ($conn->query($sql) === TRUE){
            echo "Updated Sucssesfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    else
    {
        if($_SESSION['user']=="0"){
            $sql = "delete from employee where ID=$id";
        }else if ($_SESSION['user']=="1"){
            $sql = "delete from manager where ID=$id";
        }

        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>