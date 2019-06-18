<?php
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



