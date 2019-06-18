<?php
session_start();
?>
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
        <link rel="stylesheet" href="main.css">
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
            <table class="table table-dark" id="view">
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
                    if($_SESSION['user']=="0"){
                        $sql = "SELECT * FROM employee";
                    }else if ($_SESSION['user']=="1"){
                        $sql = "SELECT * FROM manager";
                    }
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                            ?>
                            <tr id="<?php echo $row['ID']; ?>">
                                <td><?php echo $row['ID']; ?></td>
                                <td id='N' ><?php echo $row['name']; ?></td>
                                <td id='M' ><?php echo $row['mob']; ?></td>
                                <td id='E' ><?php echo $row['email']; ?></td>
                                <td id='P' ><?php echo $row['pan']; ?></td>
                                <td id='S' ><?php echo $row['sal']; ?></td>
                                <td id='J' ><?php echo $row['Jdate']; ?></td>
                                <td id='St' ><?php if($row['status']) echo "Active"; ?></td>
                                <td>
                                    <button class="btn btn-light delete" data-id="<?php echo $row['ID']; ?>">Delete</button>
                                    <button class="btn btn-light edit" data-id="<?php echo $row['ID']; ?>">Edit</button>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
            <div>
                    <button class='add-row'>Add New Record</button>
            </div>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    $(document).on('click', '.delete', function () {
                        var ID=$(this).attr('data-id');
                        $('#'+ID).remove();

                        $.ajax({
                            url: "operation.php",
                            data : {ID:ID},
                            type : 'POST',
                            success: function(result){
                                //location.reload(true);
                            }      
                        });
                    });

                    $(document).on('click', '.edit', function () {
                        $(this).html('Update');
                        var ID=$(this).attr('data-id');
                        var N=$('#'+ID+' #N').text();
                        var M=$('#'+ID+' #M').text();
                        var E=$('#'+ID+' #E').text();
                        var P=$('#'+ID+' #P').text();
                        var S=$('#'+ID+' #S').text();
                        var J=$('#'+ID+' #J').text();
                        var St=$('#'+ID+' #St').text();
                        $('#'+ID).remove();
                        $('tbody').prepend("<tr id='"+ID+"'><td>"+ID+"</td><td><input type='text' name='N' id='name' value='"+N+"'></td><td><input type='text' name='M' id='mobile' value='"+M+"'></td> <td><input type='text' name='E' id='email' value='"+E+"'></td> <td><input type='text' name='P' id='pan' value='"+P+"'></td> <td><input type='text' name='S' id='salary' value='"+S+"'></td> <td><input type='text' name='J' id='join' value='"+J+"'></td><td>"+St+"</td>  <td><button class='btn btn-light update' data-id='"+ID+"' >Update</button></td></tr>");
                    });

                    $(document).on('click', '.update', function () {
                    //$(".update").click(function(){
                        var N = $("#name").val();
                        var M = $("#mobile").val();
                        var E = $("#email").val();
                        var P = $("#pan").val();
                        var S = $("#salary").val();
                        var J = $("#join").val();
                        var ID=$(this).attr('data-id');
                        $('#'+ID).remove();
                        $.ajax({
                            url : "operation.php",
                            data : {ID:ID,N:N,M:M,E:E,P:P,S:S,J:J,S:S,J:J},
                            type : 'POST',
                            success : function(result){
                                //alert(result);
                                $('tbody').prepend("<tr id='"+ID+"'><td>"+ID+"</td><td>"+N+"</td><td>"+M+"</td> <td>"+E+"</td> <td>"+P+"</td> <td>"+S+"</td> <td>"+J+"</td><td>Active</td>  <td><button class='btn btn-light delete' data-id='"+ID+"' >Delete</button> <button class='btn btn-light edit' data-id='"+ID+"' >Edit</button></td></tr>");
                            }      
                        }); 
                    });

                    $(".add-row").click(function(){
                        $("table tbody").append("<tr><td></td><td><input type='text' name='N' id='name' value=''></td><td><input type='text' name='M' id='mobile' value=''></td> <td><input type='text' name='E' id='email' value=''></td> <td><input type='text' name='P' id='pan' value=''></td> <td><input type='text' name='S' id='salary' value=''></td> <td><input type='text' name='J' id='join' value=''></td><td></td>  <td><button class='btn btn-light add' data-id='' >Add</button></td></tr>");
                    });
                });
            </script>        
        </div>
    </body>
</html>