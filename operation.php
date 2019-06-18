<?php
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

        $sql = "UPDATE employee SET E_name='".$Name."', E_mob='".$MNumber."', E_email='".$email."' ,E_pan='".$pan."' ,E_sal='".$salary."' ,E_Jdate='".$date."' ,E_status='".$status."' WHERE ID='$id'";

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
        $sql = "delete from employee where ID=$id";

                        if ($conn->query($sql) === TRUE) {
                            echo "Record deleted successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
    }
}
?>