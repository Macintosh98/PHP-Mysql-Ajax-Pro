<!DOCTYPE html>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
    </head>

    <body>
        <script>
        function ajax(ID) {
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txt").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET","view.php?ID="+ID,true);
                xmlhttp.send();
        }
        </script>
        <div class="container" id="txt"> 
            <br><br><h1>Employees From Policy Planner</h1><p>deatails of all employees:</p><br><br>            
            <table class="table table-dark">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mobail Number</th>
                    <th>Email</th>
                    <th>Pan Number</th>
                    <th>Salary</th>
                    <th>Join Date</th>
                    <th>Status</th>
                    <th>Operations</th>
                </tr>
                </thead>
                <tbody>
                    <?php
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
                    
                    if ( isset( $_GET['ID'] ) ) {
                        $ID=$_GET['ID'];
                        $sql = "delete from employee where ID=$ID";

                        if ($conn->query($sql) === TRUE) {
                            echo "Record deleted successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                    

                    $sql = "SELECT * FROM employee";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                            ?>
                            <tr>
                                <td><?php echo $row['ID']; ?></td>
                                <td><?php echo $row['E_name']; ?></td>
                                <td><?php echo $row['E_mob']; ?></td>
                                <td><?php echo $row['E_email']; ?></td>
                                <td><?php echo $row['E_pan']; ?></td>
                                <td><?php echo $row['E_sal']; ?></td>
                                <td><?php echo $row['E_Jdate']; ?></td>
                                <td><?php echo $row['E_status']; ?></td>
                                <td>
                                    <button onclick="ajax(<?php echo $row['ID']; ?>)" class="btn btn-light">Delete</button>
                                    <button class="btn btn-light"><a href="index.php?ID=<?php echo $row['ID']; ?>">Edit</a></button>
                                </td>
                            </tr>
                            <?php
                        }
                    } 
                    else { echo "0 results"; }
                    $conn->close();
                    ?>
                </tbody>
            </table>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </div>
    </body>
</html>